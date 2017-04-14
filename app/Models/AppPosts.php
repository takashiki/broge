<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AppPosts.
 *
 * @version April 9, 2017, 4:31 am UTC
 */
class AppPosts extends Model
{
    use SoftDeletes;

    public $table = 'app_posts';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
    ];
}
