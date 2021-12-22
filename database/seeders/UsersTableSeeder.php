<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'PATRICK BIJAMPOLA',
                    'email' => 'admin@gmail.com',
                    'username'=>'Admin',
                    'password'=>Hash::make('12345678'),
                    'role'=>'admin',
                    'status'=>'active',

                ],

                //VENDOR
                [
                    'name' => 'VENDOR ',
                    'email' => 'vendor@gmail.com',
                    'username'=>'OmaryVendor',
                    'password'=>Hash::make('12345678'),
                    'role'=>'vendor',
                    'status'=>'active',

                ],
                //CUSTOMER
                [
                    'name' => 'CUSTOMER',
                    'email' => 'customer@gmail.com',
                    'username'=>'OmaryCustomer',
                    'password'=>Hash::make('12345678'),
                    'role'=>'customer',
                    'status'=>'active',

                ]
            ]);

    }
}
