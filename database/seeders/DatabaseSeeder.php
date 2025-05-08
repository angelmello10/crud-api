<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Categoria::factory(5)->create(); // aqui indico que creare 5 categorias

        \App\Models\Producto::factory(20)->create(); //aquí indio que creo 20 productos
    }
}
