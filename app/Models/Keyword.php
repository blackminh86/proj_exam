<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends AdminModel
{
    use HasFactory;
    protected $fieldSearchAccepted   = [
        'id',
        'keyword',
        'product_category_id',
        'ip'
    ];
    protected $crudNotAccepted = [
        '_token',
        'thumb_current',
        'pagination',
        'created_by',
    ];

}
