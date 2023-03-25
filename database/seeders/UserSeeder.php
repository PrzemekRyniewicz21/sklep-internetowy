<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0;$i<100;$i++){
            DB::table('users')->insert([
                'name' => Str::random(10),
                'surname' =>Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'phone_number' => '123321123',
                'password' => Hash::make('password')

            ]);
        }
    }
}
