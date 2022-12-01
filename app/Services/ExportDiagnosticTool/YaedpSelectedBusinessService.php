<?php

namespace App\Services\ExportDiagnosticTool;

use App\Models\Yaedp\YaedpBusinessDetail;
use App\Models\Yaedp\YaedpBusinessImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * Class YaedpSelectedBusinessService.
 */
class YaedpSelectedBusinessService
{
    protected ExportSelectedUserService $selectedUser;
    public function __construct(ExportSelectedUserService $selectedUser){
        $this->selectedUser = $selectedUser;
    }

    protected string $imagePath = 'photos/yaedp/business';

    public function yaedpBusinessDetail(): YaedpBusinessDetail
    {
        return new YaedpBusinessDetail();
    }

    public function getYaedpBusinessByUserId($id){
        return $this->yaedpBusinessDetail()->where('user_id', $id)->first();
    }

    public function yaedpBusinessImage(): YaedpBusinessImage
    {
        return new YaedpBusinessImage();
    }

    public function addBusinessByUserId($request, $id): array
    {
        $input = $request->all();
        $input['user_id'] = $id;

        // Add to product details
        $business = $this->yaedpBusinessDetail()->create($input);

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
                    $this->yaedpBusinessImage()->create([
                        'user_id' => $id,
                        'yaedp_business_detail_id' => $business->id,
                        'image' => $name,
                        'path' => $this->imagePath
                    ]);
                }
            }
        }

        return [
            'success' => true,
            'business' => $business,
            'message' => 'Business Submitted'
        ];
    }
}
