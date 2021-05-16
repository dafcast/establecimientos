<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre' => 'Restaurante',
            'slug' => Str::slug('Restaurante'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Café',
            'slug' => Str::slug('Café'),
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('categorias')->insert([
            'nombre' => 'Hotel',
            'slug' => Str::slug('Hotel'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Bar',
            'slug' => Str::slug('Bar'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Hospital',
            'slug' => Str::slug('Hospital'),
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('categorias')->insert([
            'nombre' => 'Gimnasio',
            'slug' => Str::slug('Gimnasio'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Doctor',
            'slug' => Str::slug('Doctor'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
