<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
        	'title' => '자유'
        ]);
        DB::table('categories')->insert([
        	'title' => '정치'
        ]);
        DB::table('categories')->insert([
        	'title' => '학교'
        ]);        
    }
}
