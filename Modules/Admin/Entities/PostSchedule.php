<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class PostSchedule extends Model
{
    protected $table = 'post_schedule';
    public $timestamps = false;
    protected $fillable = [];
}
