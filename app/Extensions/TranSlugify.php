<?php

namespace App\Extensions;

use Cocur\Slugify\Slugify;
use Translug;

class TranSlugify extends Slugify
{
    public function slugify($string, $options = null)
    {
        return preg_match("/[\x7f-\xff]/", $string) ?
            Translug::translug($string) :
            parent::slugify($string, $options);
    }
}
