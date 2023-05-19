<?php

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
            'lastname' => 'Mario',
            'firstname' => 'Luna',
            'email' => 'mario.luna@gmail.com',
            'password' => Hash::make('12345678'),
            'active' => (1),
        ]);
    }
}
