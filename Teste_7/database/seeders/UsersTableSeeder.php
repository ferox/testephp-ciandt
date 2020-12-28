<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create('pt_BR');

        $password = Hash::make('123456');

        // Usuário Administrador
        User::create([
            'name' => 'Fernando',
            'lastname' => 'Pereira dos Santos',
            'phone' => $faker->phoneNumber,
            'email' => 'fernando@gnu.org',
            'password' => $password,
            'role' => 'admin'
        ]);

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name,
                'lastname' => $faker->lastname,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'password' => $password,
                'role' => 'user'
            ]);
        }
    }
}
