<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\Yaedp\YaedpProductDetail;
use App\Models\Yaedp\YaedpProductImage;
use App\Models\Yaedp\YaedpProductParameter;
use App\Services\Base\CrudService;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Services\Yaedp\YaedpValuedChainService;

/**
 * Class ExportSelectedProductService.
 */
class YaedpSelectedProductService
{
    protected ExportSelectedUserService $selectedUser;
    public function __construct(ExportSelectedUserService $selectedUser,YaedpValuedChainService $valuedChain){
        $this->selectedUser = $selectedUser;
        $this->valuedChain = $valuedChain;
    }

    protected string $imagePath = 'photos/yaedp/products';


    public function yaedpProductDetailByValuedChainName($valued_chain)
    {
        $valued_chain= $this->valuedChain->getValuedChainByName($valued_chain)->first();

        return  YaedpProductDetail::where('yaedp_value_chain_id', $valued_chain->id);
    }    
    
    public function yaedpProductDetail(): YaedpProductDetail
    {
        return new YaedpProductDetail();
    }

    public function yaedpProductParameter(): YaedpProductParameter
    {
        return new YaedpProductParameter();
    }

    public function yaedpProductImage(): YaedpProductImage
    {
        return new YaedpProductImage();
    }

    public function getYaedpProductsByUserId($id){
        return $this->yaedpProductDetail()->where('user_id', $id);
    }

    public function addProductByUserId($request, $id): array
    {
        $input = $request->all();
        $input['user_id'] = $id;

        // Add to product details
        $product = $this->yaedpProductDetail()->create($input);

        // Add to product Parameters
        $input['yaedp_product_detail_id'] = $product->id;
        $this->yaedpProductParameter()->create($input);

        // Add images
        if(is_array($input['images']) && count($input['images']) > 0){
            foreach($input['images'] as $key => $value){
                if($file = $request->file('images')[$key]) {
                    $name = time() . $file->getClientOriginalName();
                    // create path to directory
                    if (!File::exists($this->imagePath)){
                        File::makeDirectory($this->imagePath, 0777, true, true);
                    }
                    $background = Image::canvas(500, 500);
                    // start image conversion (Must install Image Intervention Package first)
                    $convert_image = Image::make($file->path());
                    // resize image and save to converted path
                    // resize and fit width
                    $convert_image->resize(500, 500, static function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    // insert image to canvas
                    $background->insert($convert_image, 'center');
                    $background->save($this->imagePath.'/'.$name);

                    // Store images
                    $this->yaedpProductImage()->create([
                        'user_id' => $id,
                        'yaedp_product_detail_id' => $product->id,
                        'image' => $name,
                        'path' => $this->imagePath
                    ]);
                }
            }
        }

        return [
            'success' => true,
            'product' => $product,
            'message' => 'Product Submitted'
        ];
    }

    public function deleteUserProduct($userId, $productId): array
    {
        $product = $this->yaedpProductDetail()
            ->with('parameter')->findOrFail($productId);
        if($product->user_id !== $userId){
            return [
               'success' => false,
               'message' => 'You are not authorized to delete this item.'
            ];
        }
        CrudService::deleteRelations($product->images, $this->imagePath);
        CrudService::deleteRelations($product->parameter);
        return [
            'success' => true,
            'message' => 'Deleted'
        ];
    }

}
