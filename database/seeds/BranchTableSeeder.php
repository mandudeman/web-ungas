<?php

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Branch::create([
           'name'=>'Head Office',
           'location'=>'Uttara House Buildings, Dhaka Bangladesh',
           'description'=>''
        ]);
        App\Branch::create([
           'name'=>'Rajshahi Branch',
           'location'=>'Padma Graden',
           'description'=>''
        ]);
        App\Branch::create([
           'name'=>'Sirajgonj Branch',
           'location'=>'S.S Road',
           'description'=>''
        ]);
        App\Branch::create([
           'name'=>'Bogra Branch',
           'location'=>'Jolershari Tala',
           'description'=>''
        ]);



    }
}
