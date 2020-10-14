<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class UserPerms extends Model
{
    protected $table = 'user_perms';
    public $timestamps = false;
    protected $fillable = ['id','user','perms'];
}
