<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'post_tag';
	public $timestamps = false;
    protected $fillable = [];
}
