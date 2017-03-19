<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Tag;
use App\Scopes\PublishedScope;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TagRepository extends AbstractRepository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
}
