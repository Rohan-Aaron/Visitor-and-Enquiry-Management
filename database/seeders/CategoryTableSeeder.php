<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Visitorcategory')->insert([
            ['category' => 'Admission', 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Admission', 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Event', 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Conference', 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'Workshop', 'created_at' => now(), 'updated_at' => now()],
        ]);

       DB::table('Enquirycategory')->insert([
            ['course'=>'BCOM', 'combination'=>'Finance Analysis'],
       ]);
    }
}
