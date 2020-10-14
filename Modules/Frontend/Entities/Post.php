<?php

namespace Modules\Frontend\Entities;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    public $timestamps = false;
    protected $fillable = [];
}
