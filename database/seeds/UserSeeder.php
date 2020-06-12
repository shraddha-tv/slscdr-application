<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [ 
                'name' => 'Super Admin',
                'mobile' => '0123456789',
                'nic' => '0123456789v',
                'gender' => 'male',
                'birth_day' => Carbon::now(),
                'email' => 'admin@smn.lk',
                'password' => bcrypt('Admin#321'),
                'created_at' => Carbon::now()
            ]
            
        ]);
    }
}
