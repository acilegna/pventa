<?php

use Illuminate\Database\Seeder;

class CajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cajas')->insert([
            'descripcion' => 'caja2',
            'status' => 1,

        ]);
    }
}
