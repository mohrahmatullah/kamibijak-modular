<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
   	protected $table = 'post_category';
	public $timestamps = false;
    protected $fillable = [];
}
