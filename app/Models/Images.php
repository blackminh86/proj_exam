<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    public function uploadMultipleImages($filenames, $name, $altArray, $images_uploaded = null,$folderUpload)
    {
     
        $thumbName = [];
        $fileName  = [];
        $fileMerge = '';
        $slugName =  Str::of($name)->slug('-') . '-' . time();

        if ($filenames != null) {
            foreach ($filenames as $key => $image) {    
                $fileName[] = $slugName . $key . '.' . $image->clientExtension();
                //$image->storeAs($this->folderUpload, $fileName[$key], 'product_image');
                $image->storeAs($folderUpload, $fileName[$key], 'zvn_storage_image');
            }
        }
        if ($images_uploaded != null) {
            $fileMerge = array_merge($images_uploaded, $fileName);
        } else {
            $fileMerge = $fileName;
        }
        foreach ($fileMerge as $key => $name) {
            $thumbName[$key]['image'] = $name;
            $thumbName[$key]['alt']   = $altArray[$key];
        }
        $thumbName = json_encode($thumbName);
        return $thumbName;
    }
}
