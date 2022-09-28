<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends AdminModel
{
    use HasFactory;
    public function __construct(){
        $this->fieldSearchAccepted = ['value', 'product_id','attribute_id','created_at','updated_at'];
        $this->crudNotAccepted     = ['_token', 'thumb_current'];
    }
    public function product(){
        return $this->belongsTo(Product::class );
    }
    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }

}
