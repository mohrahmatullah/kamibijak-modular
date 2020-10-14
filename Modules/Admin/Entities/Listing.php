<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'listing';
	public $timestamps = false;
    protected $fillable = [];
}
