<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends \Eloquent
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
