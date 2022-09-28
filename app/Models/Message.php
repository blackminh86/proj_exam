<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends AdminModel
{
     protected $fieldSearchAccepted   = [ 'name', 'title', 'email', 'content'];
     protected $crudNotAccepted = ['_token','thumb_current','view'];
    use HasFactory;
}
