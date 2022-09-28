<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth ;
class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';

    protected $guarded = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function saveItem($params = null, $options = null) { 
        if($options['task'] == 'change-password') {
            $password       = bcrypt($params['password']);
            $id = Auth::user()->id ;
            self::where('id', $id)->update(['password' => $password]);
        }
    }
}

