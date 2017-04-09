<?php

namespace App\Repositories;

use App\Models\Tag;
use Prettus\Repository\Eloquent\BaseRepository;

class TagRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }
}
