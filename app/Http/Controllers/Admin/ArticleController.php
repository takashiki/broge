<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;

class ArticleController extends Controller
{
    protected $articleRepository;
    protected $tagRepository;

    /**
     * PostController constructor.
     *
     * @param ArticleRepository $articleRepository
     * @param TagRepository $tagRepository
     */
    public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        return view('admin.article.index');
    }

    public function create()
    {
        return view('admin.article.create', [
            'tags' => $this->tagRepository->getAll(),
        ]);
    }
}
