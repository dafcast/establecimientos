<?php

use App\User;
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
        User::create([
            'name' => 'Dayan',
            'email' => 'correo@correo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'Ferney',
            'email' => 'correo2@correo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678')
        ]);
    }
}
