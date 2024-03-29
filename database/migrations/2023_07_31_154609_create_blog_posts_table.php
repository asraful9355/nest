<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('post_title_en');
            $table->string('post_title_bn');
            $table->string('post_slug');
            $table->string('post_image');
            $table->text('post_short_description_en');
            $table->text('post_short_description_bn');
            $table->text('post_long_description_en');
            $table->text('post_long_description_bn');
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
        Schema::dropIfExists('blog_posts');
    }
};
