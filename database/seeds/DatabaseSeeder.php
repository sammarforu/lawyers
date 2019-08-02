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
        $this->call(TaxTableSeeder::class);
        $this->call(DiscountTableSeeder::class);
        $this->call(SystemLogoTableSeeder::class);
        $this->call(PartyTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(CatagoryTableSeeder::class);
        $this->call(AccountGroupSeeder::class);
        $this->call(PublisherTableSeeder::class);
        $this->call(SystemLogosTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VoucherTableSeeder::class);
        $this->call(GRNTableSeeder::class);
        $this->call(PurchaseTableSeeder::class);
        $this->call(SaleTableSeeder::class);
        $this->call(SaleTaxTableSeeder::class);
        $this->call(DeliveryChallanTableSeeder::class);
        $this->call(UOMSeeder::class);
        $this->call(WarehouseTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(LCSeeder::class);

    }
}
