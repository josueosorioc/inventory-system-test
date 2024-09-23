<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Josue Osorio',
            'email' => 'josue.osorio@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('abc.123'),
            'remember_token' => Str::random(10),
        ]);

        Articulo::create([
            'nombre' => 'Test #1',
            'descripcion' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur porro est sed iure, consequatur ab in eaque? Ratione fugit dolores voluptate nesciunt fuga laboriosam at dignissimos! Reprehenderit beatae inventore excepturi!',
            'cantidad' => 10,
            'precio' => 50.75,
            'user_id' => 1
        ]);
    }
}
