<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone_number' => '0123456789',
            'password' => bcrypt('Admin@123'),
            'role' => 'Admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'phone_number' => '0123456789',
            'password' => bcrypt('User@123'),
            'role' => 'User',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $data = [];

        for ($i = 0; $i < 3000; $i++)
        {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->numerify('##########'),
                'password' => bcrypt('Password@123'),
                'role' =>  $faker->randomElement(['Admin', 'User']),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($data, 500);
        foreach ($chunks as $chunk)
        {
            User::insert($chunk);
        }
    }
}
