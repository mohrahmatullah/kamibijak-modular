<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
	public $timestamps = false;
    protected $fillable = [];
}
