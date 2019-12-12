<?php

    use Illuminate\Database\Seeder;

    class AdminSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            DB::table('admins')->insert([
                [
                    "account" => "admin",
                    "password" => \Illuminate\Support\Facades\Hash::make("admin"),
                    "real_name"=>"admin",
                    "role" => 1,
                    "tel" => "13888888888",
                    "state" => 1,
                ],
            ]);
        }
    }
