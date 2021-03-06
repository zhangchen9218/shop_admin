<?php

use Illuminate\Database\Seeder;

class ColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('columns')->insert([
            ["name" => "新闻资讯","cotegory_id" => 1,"pid"=>0,"level"=>1,"selectable"=>0,"state"=>1],
            ["name" => "行业动态","cotegory_id" => 1,"pid" =>1,"level"=>2,"selectable"=>1,"state"=>1],
            ["name" => "行业资讯","cotegory_id" => 1,"pid" =>1,"level"=>2,"selectable"=>1,"state"=>1],
            ["name" => "娱乐八卦","cotegory_id" => 1,"pid" =>0,"level"=>1,"selectable"=>1,"state"=>1],
            ["name" => "财经新闻","cotegory_id" => 1,"pid" =>1,"level"=>2,"selectable"=>0,"state"=>1],
            ["name" => "国外财经","cotegory_id" => 1,"pid" =>5,"level"=>3,"selectable"=>1,"state"=>2],
            ["name" => "国内财经","cotegory_id" => 1,"pid" =>5,"level"=>3,"selectable"=>1,"state"=>1],
        ]);
    }
}
