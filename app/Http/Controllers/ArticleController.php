<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    public $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $models = $this->repository->page();

        dd($models);
    }

    public function show($identity)
    {
        $model = $this->repository->findByIdentity($identity);

        dd($model);
    }
}
