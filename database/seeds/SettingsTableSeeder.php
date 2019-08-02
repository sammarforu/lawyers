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
		//$setting->system_name = 'ACCOUNTS & STOCK SOLUTIONS';
		$setting->system_name = 'Lightcare (PVT.) Ltd';
		//$setting->title = 'ACCOUNTS & STOCK SOLUTIONS';
		$setting->title = 'Lightcare';
		//$setting->address = 'WAHDAT ROAD, MANSOORA DEGREE COLLEGE';
		$setting->address = '190-D2, Wapda Town, Lahore.';
		$setting->phone = '03224965616';
		$setting->email = 'info@lightcare.com';
		$setting->currency = 'PKR';
		$setting->city = '03-00-4281-958-11';
		$setting->state = '4281958-0';
		$setting->country = 'Pakistan';
		$setting->footer_line = '© 2016 ACCOUNTS & STOCK SOLUTIONS. Developed By Itlife.com.pk';
		$setting->save();
    }
}
