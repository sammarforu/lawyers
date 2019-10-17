<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        $this->call(SettingsTableSeeder::class);
        $this->call(CatagoryTableSeeder::class);
        $this->call(SystemLogosTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);


    }
}
