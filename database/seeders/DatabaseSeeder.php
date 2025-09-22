<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Motor;
use App\Models\RentalRate;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // buat akun admin
        User::factory()->create([
            'name' => 'kayy',
            'email' => 'kayllarinjanime4119@gmail.com',
            'password' => bcrypt('kayy12345'),
            'role' => 'admin',
        ]);

        // buat akun pemilik
        $owner = User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
            'role' => 'pemilik',
        ]);

        // buat akun penyewa
        User::factory()->create([
            'name' => 'Penyewa',
            'email' => 'renter@example.com',
            'password' => bcrypt('password'),
            'role' => 'penyewa',
        ]);

        // buat contoh motor
        $motor = Motor::create([
            'owner_id' => $owner->id,
            'brand' => 'Honda',
            'model' => 'Beat',
            'type_cc' => '110cc',
            'plate_number' => 'B-1234-XYZ',
            'status' => 'available',
        ]);

        // buat harga rental untuk motor tersebut
        RentalRate::create([
            'motor_id' => $motor->id,
            'daily_rate' => 100000,
            'weekly_rate' => 600000,
            'monthly_rate' => 2000000,
        ]);
    }
}
