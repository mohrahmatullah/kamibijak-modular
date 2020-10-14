<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
	protected $table = 'post_tag';
	public $timestamps = false;
    protected $fillable = [];
}
