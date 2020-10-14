<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
	protected $table = 'post_category';
	public $timestamps = false;
    protected $fillable = [];
}
