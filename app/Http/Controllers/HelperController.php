<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;

class HelperController extends Controller
{
    public function sitemap()
    {
        echo 'sitemap';
    }

    public function feed()
    {
        echo 'feed';
    }
}
