<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ["name" => "天方夜谭","state"=>1],
            ["name" => "心灵鸡汤","state"=>1],
            ["name" => "都市小说","state"=>1],
            ["name" => "爆笑故事","state"=>1],
        ]);
    }
}
