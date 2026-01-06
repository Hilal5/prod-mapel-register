<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\User;
use App\Models\Schedule;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua siswa (18 siswa, 1 per kelas)
        $students = User::where('role', 'student')->get();
        
        foreach ($students as $student) {
            // Ambil jadwal sesuai kelas siswa
            $schedules = Schedule::where('class_id', $student->class_id)
                                ->where('semester', 'ganjil')
                                ->where('academic_year', 2025)
                                ->get();

            // Group jadwal berdasarkan subject_id untuk menghindari duplikasi
            $uniqueSubjects = $schedules->groupBy('subject_id');

            // Registrasi siswa ke 1 jadwal per mata pelajaran
            foreach ($uniqueSubjects as $subjectId => $subjectSchedules) {
                // Ambil hanya 1 jadwal pertama untuk mata pelajaran ini
                $schedule = $subjectSchedules->first();
                
                Registration::create([
                    'user_id' => $student->id,
                    'subject_id' => $schedule->subject_id,
                    'schedule_id' => $schedule->id,
                    'status' => 'approved',
                    'registration_date' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}