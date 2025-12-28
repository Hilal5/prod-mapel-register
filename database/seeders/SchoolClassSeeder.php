<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['name' => '7A', 'grade' => 7, 'room' => 'R-101', 'homeroom_teacher_id' => 1, 'capacity' => 32],
            ['name' => '7B', 'grade' => 7, 'room' => 'R-102', 'homeroom_teacher_id' => 2, 'capacity' => 30],
            ['name' => '8A', 'grade' => 8, 'room' => 'R-201', 'homeroom_teacher_id' => 3, 'capacity' => 31],
            ['name' => '8B', 'grade' => 8, 'room' => 'R-202', 'homeroom_teacher_id' => 4, 'capacity' => 29],
            ['name' => '9A', 'grade' => 9, 'room' => 'R-301', 'homeroom_teacher_id' => 5, 'capacity' => 28],
            ['name' => '9B', 'grade' => 9, 'room' => 'R-302', 'homeroom_teacher_id' => 6, 'capacity' => 30],
        ];

        foreach ($classes as $class) {
            SchoolClass::create($class);
        }
    }
}