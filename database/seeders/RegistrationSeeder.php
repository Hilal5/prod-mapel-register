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
        // Ambil siswa kelas 7A (user_id 2-6)
        $students7A = User::where('class_id', 1)->where('role', 'student')->get();
        
        // Jadwal untuk kelas 7A (schedule_id 1-8)
        $schedules7A = Schedule::where('class_id', 1)->get();

        // Registrasi siswa kelas 7A ke semua mata pelajaran
        foreach ($students7A as $student) {
            foreach ($schedules7A as $schedule) {
                Registration::create([
                    'user_id' => $student->id,
                    'subject_id' => $schedule->subject_id,
                    'schedule_id' => $schedule->id,
                    'status' => 'approved',
                    'registration_date' => now()->subDays(rand(1, 30)),
                ]);
            }
        }

        // Registrasi sebagian siswa kelas 7B
        $students7B = User::where('class_id', 2)->where('role', 'student')->limit(3)->get();
        $schedules7B = Schedule::where('class_id', 2)->get();

        foreach ($students7B as $student) {
            foreach ($schedules7B as $schedule) {
                Registration::create([
                    'user_id' => $student->id,
                    'subject_id' => $schedule->subject_id,
                    'schedule_id' => $schedule->id,
                    'status' => rand(0, 1) ? 'approved' : 'pending',
                    'registration_date' => now()->subDays(rand(1, 20)),
                ]);
            }
        }

        // Registrasi beberapa siswa kelas 8A
        $students8A = User::where('class_id', 3)->where('role', 'student')->limit(4)->get();
        $schedules8A = Schedule::where('class_id', 3)->get();

        foreach ($students8A as $student) {
            foreach ($schedules8A as $schedule) {
                Registration::create([
                    'user_id' => $student->id,
                    'subject_id' => $schedule->subject_id,
                    'schedule_id' => $schedule->id,
                    'status' => 'approved',
                    'registration_date' => now()->subDays(rand(1, 15)),
                ]);
            }
        }
    }
}