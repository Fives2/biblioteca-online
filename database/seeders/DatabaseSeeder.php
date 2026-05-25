<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário Admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@biblioteca.com',
            'password' => bcrypt('password'),
        ]);

        // Usuários comuns
        User::factory(10)->create();

        // Chama os outros seeders
        $this->call([
            AuthorSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            LoanSeeder::class,
        ]);
    }
}