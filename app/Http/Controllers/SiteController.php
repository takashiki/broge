<?php

namespace App\Http\Controllers;

use App;
use App\Repositories\ArticleRepository;
use Carbon\Carbon;
use URL;

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

    public function sitemap()
    {
        $sitemap = App::make('sitemap');

        $sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');

        $posts = $this->repository->getAllFeedItems();

        // add every post to the sitemap
        foreach ($posts as $post) {
            $sitemap->add($post->getLink(), $post->updated_at, '0.8', 'monthly');
        }

        return $sitemap->render('xml');
    }
}
