<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64);
            $table->string('desc', 256)->nullable()->comment('Article description');
            $table->integer('cid')->nullable()->default(0)->comment('category id');
            $table->boolean('is_wiki')->default(false)->comment('Is Add to wiki？');
            $table->integer('views')->default()->comment('view count');
            $table->tinyInteger('status')->default(1)->comment('1published 0unpublished -1deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
