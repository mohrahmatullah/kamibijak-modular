<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class GalleryMedia extends Model
{
	protected $table = 'gallery_media';
	public $timestamps = false;
    protected $fillable = [];
}
