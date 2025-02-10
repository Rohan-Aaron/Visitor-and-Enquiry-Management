<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class adminUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'Admin',
            'email' =>'admin@staloysius.edu.in',
            'password'=>Hash::make('Sau@Support'),
            'remember_token' => Str::random(10),          // Random string for remember token
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
