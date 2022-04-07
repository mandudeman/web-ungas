<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user=\App\User::create([
            'name'=>'admin',
            'email'=>'admin@eaccount.xyz',
            'role_manage_id'=>1,
            'password'=>bcrypt('1234'),
            'create_by'=>'System',
        ]);


        \App\Profile::create([
            "user_ID"=> $user->id,
            "first_name"=>"Super",
            "last_name"=>"Admin",
            "gender"=>1,
            "designation"=>"PHP Developer",
            "phone_number"=>"+8801738578683",
            "NID"=>"199412478654477",
            "permanent_address"=>"PS: Raygonj, District: Sirajgonj",
            "present_address"=>"Dhaka,Bangladesh",
            'avatar'=>'upload/avatar/avatar.png',
            "education"=>'B.S. in Computer Science from the University of Primeasia University',
            'description'=>''
        ]);


    }
}
