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
         \App\Models\User::factory(5)->create();
         \App\Models\Company::factory(5)->create();
         \App\Models\Customer::factory(50)->create();

         //\App\Models\User::factory()->create([
             //'name' => 'Denys',
             //'email' => 'denis.od.ua.web@gmail.com',
         //]);
    }
}
