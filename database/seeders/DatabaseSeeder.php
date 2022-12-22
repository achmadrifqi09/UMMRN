<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Student;
use App\Models\Researcher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Researcher::create([
            'name' => 'Ilyas Nuryasin',
            'interest' => 'RPL',
            'phone' => '081238654279',
            'email' => 'ilyasnuryasin@webmail.umm.ac.id',
            'password' => bcrypt('admin123'),
            'role'=>'Super Researcher',
            'status' => 'Active',
        ]);
    }
}
