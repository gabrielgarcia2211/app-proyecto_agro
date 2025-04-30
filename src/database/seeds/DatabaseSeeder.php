<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $rol = [
            [
                'id' => 1,
                'nombre_rol' => 'a',
                'created_at' => '2020-10-31 16:43:35',
                'updated_at' => '2020-10-31 16:43:35',
            ],
            [
                'id' => 2,
                'nombre_rol' => 'es',
                'created_at' => '2020-10-31 16:43:41',
                'updated_at' => '2020-10-31 16:43:42',
            ],
            [
                'id' => 3,
                'nombre_rol' => 'em',
                'created_at' => '2020-10-31 16:43:47',
                'updated_at' => '2020-10-31 16:43:48',
            ]
        ];

        $personas = [
            [
                'documento' => 12345678,
                'nombres' => 'Juan',
                'apellidos' => 'Pérez',
                'celular' => '987654321',
                'correo' => 'juan@example.com',
                'telefono' => '1234567',
                'tipo_documento' => 'DNI',
                'direccion' => 'Calle Principal 123',
            ]
        ];

        $usuarios = [
            [
                'codigo' => 115,
                'documento' => 12345678,
                'email' => 'usuario1@example.com',
                'email_verified_at' => now(),
                'password' => md5('password'),
                'remember_token' => Str::random(10),
                'rol' => 1,
            ]
        ];

        DB::table('rols')->insert($rol);
        DB::table('personas')->insert($personas);
        DB::table('users')->insert($usuarios);
    }
}
