<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('post_tags', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('tag_id');
            $table->primary(['tag_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('post_tags');
    }
}
