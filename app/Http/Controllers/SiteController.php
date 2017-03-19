<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;

class SiteController extends Controller
{
    public $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function archives()
    {
        echo 'archives';
    }

    public function search()
    {
        echo 'search';
    }
}
