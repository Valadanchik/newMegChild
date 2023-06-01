<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => env('SUPERVISOR_EMAIL'),
            'password' => Hash::make(env('SUPERVISOR_PASSWORD')),
        ]);

        dd($user->createToken('MyApp')->plainTextToken);
    }
}
