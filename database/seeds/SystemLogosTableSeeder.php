<?php

use Illuminate\Database\Seeder;
use App\SystemLogo;
class SystemLogosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $logo = new SystemLogo();
      $logo->image = "logo.png";
      $logo->save();
    }
}
