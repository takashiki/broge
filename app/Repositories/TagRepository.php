<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends AbstractRepository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return Tag::get();
    }
}
