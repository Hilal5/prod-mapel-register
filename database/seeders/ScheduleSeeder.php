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
        // Mapping subject_id ke teacher_id dari SubjectSeeder
        $subjectTeachers = [
            1 => 2,  // Bahasa Indonesia -> Teacher 2
            2 => 5,  // Bahasa Inggris -> Teacher 5
            3 => 3,  // IPA -> Teacher 3
            4 => 4,  // IPS -> Teacher 4
            5 => 1,  // Matematika -> Teacher 1
            6 => 6,  // PAI -> Teacher 6
            7 => 15, // Seni Budaya -> Teacher 15
            8 => 7,  // PJOK -> Teacher 7
        ];

        // Mapping class_id ke room dari SchoolClassSeeder
        $classRooms = [
            // Kelas VII (1-6)
            1 => 'R-101',  2 => 'R-102',  3 => 'R-103',  
            4 => 'R-104',  5 => 'R-105',  6 => 'R-106',
            // Kelas VIII (7-12)
            7 => 'R-201',  8 => 'R-202',  9 => 'R-203',  
            10 => 'R-204', 11 => 'R-205', 12 => 'R-206',
            // Kelas IX (13-18)
            13 => 'R-301', 14 => 'R-302', 15 => 'R-303', 
            16 => 'R-304', 17 => 'R-305', 18 => 'R-306',
        ];

        // Jadwal per hari (4 jam pelajaran)
        $timeSlots = [
            ['start_time' => '07:00', 'end_time' => '08:00'],
            ['start_time' => '08:10', 'end_time' => '09:10'],
            ['start_time' => '10:00', 'end_time' => '11:00'],
            ['start_time' => '11:10', 'end_time' => '12:10'],
        ];

        // Hari dalam seminggu (Senin - Sabtu)
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Jadwal mapel untuk KELAS VII (class_id 1-6)
        $schedulePatternVII = [
            'Senin' => [
                1 => [5, 5, 1, 1],  2 => [1, 1, 5, 5],  3 => [3, 3, 2, 2],  
                4 => [2, 2, 3, 3],  5 => [4, 4, 6, 6],  6 => [6, 6, 4, 4],
            ],
            'Selasa' => [
                1 => [3, 3, 2, 2],  2 => [2, 2, 3, 3],  3 => [5, 5, 1, 1],  
                4 => [1, 1, 5, 5],  5 => [6, 6, 4, 4],  6 => [4, 4, 6, 6],
            ],
            'Rabu' => [
                1 => [4, 4, 6, 6],  2 => [6, 6, 4, 4],  3 => [1, 1, 5, 5],  
                4 => [5, 5, 1, 1],  5 => [2, 2, 3, 3],  6 => [3, 3, 2, 2],
            ],
            'Kamis' => [
                1 => [1, 1, 3, 3],  2 => [3, 3, 1, 1],  3 => [4, 4, 6, 6],  
                4 => [6, 6, 4, 4],  5 => [5, 5, 2, 2],  6 => [2, 2, 5, 5],
            ],
            'Jumat' => [
                1 => [6, 6, 7, 8],  2 => [7, 8, 6, 6],  3 => [2, 2, 4, 4],  
                4 => [4, 4, 2, 2],  5 => [1, 1, 3, 3],  6 => [3, 3, 1, 1],
            ],
            'Sabtu' => [
                1 => [2, 2, 4, 4],  2 => [4, 4, 2, 2],  3 => [6, 6, 7, 8],  
                4 => [7, 8, 6, 6],  5 => [3, 3, 5, 5],  6 => [5, 5, 3, 3],
            ],
        ];

        // Jadwal mapel untuk KELAS VIII (class_id 7-12)
        $schedulePatternVIII = [
            'Senin' => [
                7 => [1, 1, 5, 5],   8 => [5, 5, 1, 1],   9 => [2, 2, 3, 3],  
                10 => [3, 3, 2, 2],  11 => [6, 6, 4, 4],  12 => [4, 4, 6, 6],
            ],
            'Selasa' => [
                7 => [2, 2, 3, 3],   8 => [3, 3, 2, 2],   9 => [1, 1, 5, 5],  
                10 => [5, 5, 1, 1],  11 => [4, 4, 6, 6],  12 => [6, 6, 4, 4],
            ],
            'Rabu' => [
                7 => [6, 6, 4, 4],   8 => [4, 4, 6, 6],   9 => [5, 5, 1, 1],  
                10 => [1, 1, 5, 5],  11 => [3, 3, 2, 2],  12 => [2, 2, 3, 3],
            ],
            'Kamis' => [
                7 => [3, 3, 1, 1],   8 => [1, 1, 3, 3],   9 => [6, 6, 4, 4],  
                10 => [4, 4, 6, 6],  11 => [2, 2, 5, 5],  12 => [5, 5, 2, 2],
            ],
            'Jumat' => [
                7 => [7, 8, 6, 6],   8 => [6, 6, 7, 8],   9 => [4, 4, 2, 2],  
                10 => [2, 2, 4, 4],  11 => [3, 3, 1, 1],  12 => [1, 1, 3, 3],
            ],
            'Sabtu' => [
                7 => [4, 4, 2, 2],   8 => [2, 2, 4, 4],   9 => [7, 8, 6, 6],  
                10 => [6, 6, 7, 8],  11 => [5, 5, 3, 3],  12 => [3, 3, 5, 5],
            ],
        ];

        // Jadwal mapel untuk KELAS IX (class_id 13-18)
        $schedulePatternIX = [
            'Senin' => [
                13 => [5, 5, 1, 1],  14 => [1, 1, 5, 5],  15 => [3, 3, 2, 2],  
                16 => [2, 2, 3, 3],  17 => [4, 4, 6, 6],  18 => [6, 6, 4, 4],
            ],
            'Selasa' => [
                13 => [3, 3, 2, 2],  14 => [2, 2, 3, 3],  15 => [5, 5, 1, 1],  
                16 => [1, 1, 5, 5],  17 => [6, 6, 4, 4],  18 => [4, 4, 6, 6],
            ],
            'Rabu' => [
                13 => [4, 4, 6, 6],  14 => [6, 6, 4, 4],  15 => [1, 1, 5, 5],  
                16 => [5, 5, 1, 1],  17 => [2, 2, 3, 3],  18 => [3, 3, 2, 2],
            ],
            'Kamis' => [
                13 => [1, 1, 3, 3],  14 => [3, 3, 1, 1],  15 => [4, 4, 6, 6],  
                16 => [6, 6, 4, 4],  17 => [5, 5, 2, 2],  18 => [2, 2, 5, 5],
            ],
            'Jumat' => [
                13 => [6, 6, 7, 8],  14 => [7, 8, 6, 6],  15 => [2, 2, 4, 4],  
                16 => [4, 4, 2, 2],  17 => [1, 1, 3, 3],  18 => [3, 3, 1, 1],
            ],
            'Sabtu' => [
                13 => [2, 2, 4, 4],  14 => [4, 4, 2, 2],  15 => [6, 6, 7, 8],  
                16 => [7, 8, 6, 6],  17 => [3, 3, 5, 5],  18 => [5, 5, 3, 3],
            ],
        ];

        $schedules = [];

        // Generate jadwal untuk KELAS VII (class_id 1-6)
        foreach ($days as $day) {
            for ($classId = 1; $classId <= 6; $classId++) {
                for ($slot = 0; $slot < 4; $slot++) {
                    $subjectId = $schedulePatternVII[$day][$classId][$slot];
                    $schedules[] = [
                        'subject_id' => $subjectId,
                        'class_id' => $classId,
                        'teacher_id' => $subjectTeachers[$subjectId],
                        'day' => $day,
                        'start_time' => $timeSlots[$slot]['start_time'],
                        'end_time' => $timeSlots[$slot]['end_time'],
                        'room' => $classRooms[$classId],
                        'semester' => 'ganjil',
                        'academic_year' => 2025,
                    ];
                }
            }
        }

        // Generate jadwal untuk KELAS VIII (class_id 7-12)
        foreach ($days as $day) {
            for ($classId = 7; $classId <= 12; $classId++) {
                for ($slot = 0; $slot < 4; $slot++) {
                    $subjectId = $schedulePatternVIII[$day][$classId][$slot];
                    $schedules[] = [
                        'subject_id' => $subjectId,
                        'class_id' => $classId,
                        'teacher_id' => $subjectTeachers[$subjectId],
                        'day' => $day,
                        'start_time' => $timeSlots[$slot]['start_time'],
                        'end_time' => $timeSlots[$slot]['end_time'],
                        'room' => $classRooms[$classId],
                        'semester' => 'ganjil',
                        'academic_year' => 2025,
                    ];
                }
            }
        }

        // Generate jadwal untuk KELAS IX (class_id 13-18)
        foreach ($days as $day) {
            for ($classId = 13; $classId <= 18; $classId++) {
                for ($slot = 0; $slot < 4; $slot++) {
                    $subjectId = $schedulePatternIX[$day][$classId][$slot];
                    $schedules[] = [
                        'subject_id' => $subjectId,
                        'class_id' => $classId,
                        'teacher_id' => $subjectTeachers[$subjectId],
                        'day' => $day,
                        'start_time' => $timeSlots[$slot]['start_time'],
                        'end_time' => $timeSlots[$slot]['end_time'],
                        'room' => $classRooms[$classId],
                        'semester' => 'ganjil',
                        'academic_year' => 2025,
                    ];
                }
            }
        }

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}