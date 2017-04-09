<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

class ArticleRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * Get the page of articles.
     *
     * @param int    $number
     * @param string $sort
     * @param string $sortColumn
     *
     * @return LengthAwarePaginator
     */
    public function page($number = 10, $sort = 'desc', $sortColumn = 'updated_at')
    {
        return $this->model->orderBy($sortColumn, $sort)->paginate($number);
    }

    /**
     * Get the article record.
     *
     * @param int $identity
     *
     * @return Post
     */
    public function findByIdentity($identity)
    {
        return $this->model->orWhere('id', $identity)->orWhere('slug', $identity)->firstOrFail();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Post[]
     */
    public function getAllFeedItems()
    {
        return $this->model->orderBy('updated_at', 'desc')->get();
    }
}
