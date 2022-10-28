<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        $admin = User::create([
            'name' => 'Hareera Mushtaq',
            'email' => 'hareeramushtaq1107@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $admin->assignRole('super-admin');

        $writer = User::create([
            'name' => 'Writer',
            'email' => 'writer@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $writer->assignRole('writer');


    }
}
