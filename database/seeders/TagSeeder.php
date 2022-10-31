<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->createMany([
            ['name' => 'Indeterminado'],
            ['name' => 'Servicios'],
            ['name' => 'Vivienda'],
            ['name' => 'Viáticos'],
            ['name' => 'Vehiculo'],
            ['name' => 'Salud'],
            ['name' => 'Limpieza'],
            ['name' => 'Impuestos'],
            ['name' => 'Alimentación'],
            ['name' => 'Indumentaria'],
            ['name' => 'Cuidado Personal'],
            ['name' => 'Entretenimiento'],
            ['name' => 'Para algo trabajo'],
            ['name' => 'Extras'],
            ['name' => 'Regalos'],
            ['name' => 'Mascotas'],
            ['name' => 'Vacaciones'],
        ]);
    }
}
