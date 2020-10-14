<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class ListingCategory extends Model
{
    protected $table = 'listing_category';
	public $timestamps = false;
    protected $fillable = [];
}
