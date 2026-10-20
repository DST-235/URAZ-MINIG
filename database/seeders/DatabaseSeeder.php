<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@app.com'], [
            'name'              => 'Admin',
            'password'          => '12345678',
            'role'              => 'admin',
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);

        $this->call(UrazSeeder::class);
        $this->call(ImageSeeder::class);
    }
}
