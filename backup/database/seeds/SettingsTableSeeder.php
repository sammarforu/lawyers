<?php

use Illuminate\Database\Seeder;
use App\Setting;
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
		$setting->system_name = 'ACCOUNTS & STOCK SOLUTIONS';
		$setting->title = 'ACCOUNTS & STOCK SOLUTIONS';
		$setting->address = 'WAHDAT ROAD, MANSOORA DEGREE COLLEGE';
		$setting->phone = '03214197290';
		$setting->email = 'SAMMARFORU@GMAIL.COM';
		$setting->currency = 'PKR';
		$setting->city = '123456-7';
		$setting->state = '765432-1';
		$setting->country = 'Pakistan';
		$setting->footer_line = '© 2016 ACCOUNTS & STOCK SOLUTIONS. Developed By Itlife.com.pk';
		$setting->save();
    }
}
