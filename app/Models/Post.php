<?php

namespace App\Models;

use App\Extensions\TranSlugify;
use Cocur\Slugify\Slugify;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\FeedItem;

/**
 * App\Models\Post.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int $view_count
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereViewCount($value)
 */
class Post extends \Eloquent implements FeedItem
{
    use Sluggable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'slug',
    ];

    public static $rules = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * @param \Cocur\Slugify\Slugify $engine
     * @param string $attribute
     *
     * @return \Cocur\Slugify\Slugify
     */
    public function customizeSlugEngine(Slugify $engine, $attribute)
    {
        return new TranSlugify();
    }

    public function getLink()
    {
        return route('article.show', ['identity' => $this->slug]);
    }

    public function getFeedItemId()
    {
        return $this->getLink();
    }

    public function getFeedItemTitle()
    {
        return $this->title;
    }

    public function getFeedItemUpdated()
    {
        return $this->updated_at;
    }

    public function getFeedItemSummary()
    {
        return \Markdown::convert($this->content);
    }

    public function getFeedItemLink()
    {
        return $this->getLink();
    }

    public function getFeedItemAuthor()
    {
        return 'broge';
    }
}
