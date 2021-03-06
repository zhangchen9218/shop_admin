<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ColumnSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PowerSeeder::class);
    }
}
