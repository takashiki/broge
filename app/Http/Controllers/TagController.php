<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;

class TagController extends Controller
{
    public $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        echo 'index@tag';
    }

    public function show($tag)
    {
        echo $tag.'@tag';
    }
}
