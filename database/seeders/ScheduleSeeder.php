<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            // Kelas 7A
            ['subject_id' => 1, 'class_id' => 1, 'teacher_id' => 1, 'day' => 'Senin', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-101', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 2, 'class_id' => 1, 'teacher_id' => 2, 'day' => 'Senin', 'start_time' => '08:30', 'end_time' => '10:00', 'room' => 'R-101', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 3, 'class_id' => 1, 'teacher_id' => 3, 'day' => 'Selasa', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'Lab IPA', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 4, 'class_id' => 1, 'teacher_id' => 4, 'day' => 'Selasa', 'start_time' => '10:15', 'end_time' => '11:45', 'room' => 'R-101', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 5, 'class_id' => 1, 'teacher_id' => 5, 'day' => 'Rabu', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-101', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 6, 'class_id' => 1, 'teacher_id' => 8, 'day' => 'Rabu', 'start_time' => '08:30', 'end_time' => '10:00', 'room' => 'R-101', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 7, 'class_id' => 1, 'teacher_id' => 6, 'day' => 'Kamis', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-Seni', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 8, 'class_id' => 1, 'teacher_id' => 7, 'day' => 'Jumat', 'start_time' => '07:00', 'end_time' => '09:00', 'room' => 'Lapangan', 'semester' => 'ganjil', 'academic_year' => 2025],
            
            // Kelas 7B
            ['subject_id' => 1, 'class_id' => 2, 'teacher_id' => 1, 'day' => 'Senin', 'start_time' => '10:15', 'end_time' => '11:45', 'room' => 'R-102', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 2, 'class_id' => 2, 'teacher_id' => 2, 'day' => 'Selasa', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-102', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 3, 'class_id' => 2, 'teacher_id' => 3, 'day' => 'Selasa', 'start_time' => '08:30', 'end_time' => '10:00', 'room' => 'Lab IPA', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 4, 'class_id' => 2, 'teacher_id' => 4, 'day' => 'Rabu', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-102', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 5, 'class_id' => 2, 'teacher_id' => 5, 'day' => 'Rabu', 'start_time' => '10:15', 'end_time' => '11:45', 'room' => 'R-102', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 6, 'class_id' => 2, 'teacher_id' => 8, 'day' => 'Kamis', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-102', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 7, 'class_id' => 2, 'teacher_id' => 6, 'day' => 'Kamis', 'start_time' => '10:15', 'end_time' => '11:45', 'room' => 'R-Seni', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 8, 'class_id' => 2, 'teacher_id' => 7, 'day' => 'Jumat', 'start_time' => '09:00', 'end_time' => '11:00', 'room' => 'Lapangan', 'semester' => 'ganjil', 'academic_year' => 2025],
            
            // Kelas 8A
            ['subject_id' => 1, 'class_id' => 3, 'teacher_id' => 1, 'day' => 'Selasa', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-201', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 2, 'class_id' => 3, 'teacher_id' => 2, 'day' => 'Selasa', 'start_time' => '10:15', 'end_time' => '11:45', 'room' => 'R-201', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 3, 'class_id' => 3, 'teacher_id' => 3, 'day' => 'Rabu', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'Lab IPA', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 4, 'class_id' => 3, 'teacher_id' => 4, 'day' => 'Rabu', 'start_time' => '08:30', 'end_time' => '10:00', 'room' => 'R-201', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 5, 'class_id' => 3, 'teacher_id' => 5, 'day' => 'Kamis', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-201', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 6, 'class_id' => 3, 'teacher_id' => 8, 'day' => 'Kamis', 'start_time' => '08:30', 'end_time' => '10:00', 'room' => 'R-201', 'semester' => 'ganjil', 'academic_year' => 2025],
            
            // Kelas 8B, 9A, 9B - tambahkan sesuai kebutuhan (simplified untuk contoh)
            ['subject_id' => 1, 'class_id' => 4, 'teacher_id' => 1, 'day' => 'Rabu', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-202', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 2, 'class_id' => 4, 'teacher_id' => 2, 'day' => 'Rabu', 'start_time' => '08:30', 'end_time' => '10:00', 'room' => 'R-202', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 1, 'class_id' => 5, 'teacher_id' => 1, 'day' => 'Kamis', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-301', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 2, 'class_id' => 5, 'teacher_id' => 2, 'day' => 'Kamis', 'start_time' => '08:30', 'end_time' => '10:00', 'room' => 'R-301', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 1, 'class_id' => 6, 'teacher_id' => 1, 'day' => 'Jumat', 'start_time' => '07:00', 'end_time' => '08:30', 'room' => 'R-302', 'semester' => 'ganjil', 'academic_year' => 2025],
            ['subject_id' => 2, 'class_id' => 6, 'teacher_id' => 2, 'day' => 'Jumat', 'start_time' => '08:30', 'end_time' => '10:00', 'room' => 'R-302', 'semester' => 'ganjil', 'academic_year' => 2025],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}