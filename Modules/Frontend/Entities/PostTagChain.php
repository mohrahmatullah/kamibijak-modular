<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;

class PostTagChain extends Model
{
    protected $table = 'post_tag_chain';
	public $timestamps = false;
    protected $fillable = [];
}
