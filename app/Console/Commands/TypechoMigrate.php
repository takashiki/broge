<?php

namespace App\Console\Commands;

use App\Enums\PostType;
use App\Models\Post;
use DB;
use Illuminate\Console\Command;

class TypechoMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'typecho:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from typecho.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->migrateArticle();
    }

    protected function migrateArticle()
    {
        foreach (DB::table('typecho_contents')->select(['cid', 'title', 'slug', 'created', 'modified', 'text'])
                     ->where('type', 'post')
                     ->cursor() as $post) {
            DB::table('posts')->insert([
                'id' => $post->cid,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => str_replace('<!--markdown-->', '', $post->text),
                'type' => PostType::ARTICLE,
                'created_at' => date('Y-m-d H:i:s', $post->created),
                'updated_at' => date('Y-m-d H:i:s', $post->modified),
            ]);
        }
    }
}
