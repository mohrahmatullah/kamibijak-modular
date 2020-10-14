<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class SiteParam extends Model
{
    protected $table = 'site_params';
	public $timestamps = false;
    protected $fillable = [];
}
