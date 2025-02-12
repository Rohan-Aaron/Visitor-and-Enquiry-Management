<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['program' => 'UG', 'course' => 'B.A. (Bachelor of Arts)'],
            ['program' => 'UG', 'course' =>  'B.Sc. (Bachelor of Science)'],
            ['program' => 'UG', 'course' =>  'B.Com. (Bachelor of Commerce)'],
            ['program' => 'UG', 'course' =>  'B.B.A. (Bachelor of Business Administration)'],
            ['program' => 'UG', 'course' => 'B.Voc (BACHELOR OF VOCATIONAL PROGRAMMES)'],
            ['program' => 'UG', 'course' => 'BCA (Bachelor of Computer Applications)'],
            ['program' => 'UG', 'course' => 'B.COM. (Apprenticeship/ Internship Embedded)'],
        ];

        foreach ($courses as $course) {
            $program = Program::where('title', $course['program'])->first();

            Course::create(
                [
                    'title' => $course['course'],
                    'program_id' => $program->id,
                    'status' => 1,
                ]
            );
        }
    }
}
