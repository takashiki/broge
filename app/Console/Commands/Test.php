<?php

namespace App\Console\Commands;

use Consatan\Weibo\ImageUploader\Client;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $weibo = new Client();

        try {
            $url = $weibo->upload(fopen('E:/temp/j0mj72jr.jpg', 'r'), config('services.weibo.username'), config('services.weibo.password'));

            $this->info($url);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
