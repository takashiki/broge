<?php

namespace App\Models;

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
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function getFeedItemId()
    {
        return $this->getFeedItemLink();
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
        return action('ArticleController@show', ['identity' => $this->slug]);
    }

    public function getFeedItemAuthor()
    {
        return 'broge';
    }
}
