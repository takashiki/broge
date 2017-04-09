<?php

namespace App\Repositories;

use App\Models\AppPosts;
use InfyOm\Generator\Common\BaseRepository;

class AppPostsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
    ];

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return AppPosts::class;
    }
}
