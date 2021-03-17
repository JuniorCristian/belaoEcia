<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Master',
            'email' => 'master@gmail.com',
            'password' => Hash::make('54321'),
            'profile_photo_path' => 'profile/cristian_junior-2020-11-24_22:46:50.jpg',
        ]);
    }
}
