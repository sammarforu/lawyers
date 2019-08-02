<?php

use Illuminate\Database\Seeder;
use App\Publisher;
class PublisherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $publisher = new Publisher();
       $publisher->name = 'No Publisher';
       $publisher->save();
    }
}
