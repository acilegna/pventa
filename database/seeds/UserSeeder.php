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
            'lastname' => 'Angie',
            'firstname' => 'Luna',
            'email' => 'acilegna.airam88@gmail.com',
            'passwd' => Hash::make('12345678'),
            'active' => (1),
        ]);
    }
}
