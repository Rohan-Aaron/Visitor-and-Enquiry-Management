<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            'UG',
            'PG',
            'Ph.D.',
            'B.Ed',
        ];

        foreach ($programs as $program) {
            Program::create([
                'title' => $program,
                'status' => 1,
            ]);
        }
    }
}
