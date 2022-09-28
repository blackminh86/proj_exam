<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB; 
class Banner extends AdminModel
{
    public function __construct() {
        $this->table               = 'banners';
        $this->folderUpload        = 'banner' ; 
        $this->fieldSearchAccepted = ['id', 'name', 'description', 'link' , 'type']; 
        $this->crudNotAccepted     = ['_token','thumb_current'];
    }

    public function showBanner(){
        $items = self::select('name' , 'description' , 'link' , 'thumb' , 'type')
                            ->where('status','active')
                            ->get() ;
        return $items ;    
    }

}

