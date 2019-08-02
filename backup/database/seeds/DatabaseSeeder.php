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
        $this->call(UserTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TaxTableSeeder::class);
        $this->call(DiscountTableSeeder::class);
        $this->call(SystemLogoTableSeeder::class);
        $this->call(PartyTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(CatagoryTableSeeder::class);
        $this->call(PublisherTableSeeder::class);
        $this->call(SystemLogosTableSeeder::class);
    }
}
