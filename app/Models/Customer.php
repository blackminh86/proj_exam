<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends AdminModel
{
    protected $fieldSearchAccepted   = ['id', 'fullname', 'email', 'address', 'phone'];
    protected $fillable   = ['id', 'fullname', 'email', 'address', 'phone'];
    use HasFactory;
    
}
