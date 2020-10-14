<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [];
}
