<?php

namespace Database\Seeders;

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
    }
}
