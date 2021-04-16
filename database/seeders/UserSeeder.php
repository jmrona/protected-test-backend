<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateNow = Carbon::now();

        DB::table('users')->insert([
            'firstName' => 'Protected',
            'lastName' => 'TotalAV',
            'userName' => 'protected',
            'password' => Hash::make('protected'),
            'canSignIn' => true,
            'darkMode' => false,
            'created_at' => $dateNow,
            'updated_at' => $dateNow,
        ]);
    }
}
