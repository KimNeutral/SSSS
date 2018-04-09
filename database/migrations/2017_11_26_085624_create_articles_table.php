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
            $table->integer('user_id')->unsigned();
            $table->integer('articlecategory_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('desc');
            $table->text('content');
            $table->integer('seen')->default(0);
            $table->string('thumbImage')->nullable();
            $table->timestamps();
        });

        Schema::table('articles', function($table) {
            $table->foreign('user_id', 'articles_user_id_foreign_1')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id', 'articles_category_id_foreign_1')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('articlecategory_id', 'articles_articlecategory_id_foreign_1')->references('id')->on('articlecategories')->onDelete('cascade');
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
