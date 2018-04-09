<?php

use Illuminate\Database\Seeder;

class ArticleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('articlecategories')->insert([
        	'title' => '게시판'
        ]);
        DB::table('articlecategories')->insert([
        	'title' => '토론장'
        ]);
    }
}
