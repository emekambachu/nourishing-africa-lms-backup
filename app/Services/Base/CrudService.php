<?php

namespace App\Services\Base;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * Class CrudService.
 */
class CrudService
{
    protected static function publishItem($item): array
    {
        $message = '';
        if($item->status === 1){
            $item->status = 0;
            $item_name = $item->name ?? $item->title;
            $message = $item_name.' is pending';
        }else{
            $item->status = 1;
            $item_name = $item->name ?? $item->title;
            $message = $item_name.' is published';
        }
        $item->save();

        return [
            'item' => $item,
            'message' => $message,
        ];
    }

    public static function compressAndUploadImage($request, $path, $width, $height)
    {
        if($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            // create path to directory
            if (!File::exists($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $background = Image::canvas($width, $height);
            // start image conversion (Must install Image Intervention Package first)
            $convert_image = Image::make($file->path());
            // resize image and save to converted path
            // resize and fit width
            $convert_image->resize($width, $height, static function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            // insert image to canvas
            $background->insert($convert_image, 'center');
            $background->save($path.'/'.$name);
            // Return full image upload path
            return $name;
        }
        return false;
    }

    public static function uploadDocument($request, $path)
    {
        if($file = $request->file('document')) {
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path($path), $name);
            return $name;
        }
        return false;
    }

    public static function deleteFile($fileName, $filePath): void
    {
        if(File::exists(public_path() . '/'.$filePath.'/' . $fileName)){
            FILE::delete(public_path() . '/'.$filePath.'/' . $fileName);
        }
    }

    public static function deleteRelations($items, $path = null): void
    {
        if($items->count() > 0){
            foreach($items as $item){
                $item_file = $item->photo ?? $item->document ?? $item->image ?? $item->file;
                if($path !== null && !empty($item_file) && File::exists(public_path() . '/'.$path.'/' . $item_file)) {
                    FILE::delete(public_path() . '/'.$path.'/' . $item_file);
                }
                $item->delete();
            }
        }
    }
}
