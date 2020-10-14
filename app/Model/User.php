<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
Use App\Model\UserPerms;

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;

}
