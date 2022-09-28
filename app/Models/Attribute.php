<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends AdminModel
{
    use HasFactory;
    public function __construct(){
        $this->fieldSearchAccepted = ['name', 'id','created_at','updated_at'];
        $this->crudNotAccepted     = ['_token', 'thumb_current'];
    }

    public function attributeProduct(){
        return $this->hasMany(AttributeProduct::class);
    }
}
