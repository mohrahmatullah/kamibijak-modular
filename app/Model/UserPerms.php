<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
Use App\Model\User;

class UserPerms extends Model
{
    protected $table = 'user_perms';
    public $timestamps = false;
    protected $fillable = ['id','user','perms'];
}
