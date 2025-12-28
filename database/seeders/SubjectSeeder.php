<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'code' => 'MTK',
                'name' => 'Matematika',
                'description' => 'Mata pelajaran yang mempelajari tentang angka, rumus, dan logika',
                'credits' => 4,
                'teacher_id' => 1,
                'semester' => 'ganjil',
                'quota' => 30,
            ],
            [
                'code' => 'BIND',
                'name' => 'Bahasa Indonesia',
                'description' => 'Mata pelajaran bahasa nasional Indonesia',
                'credits' => 4,
                'teacher_id' => 2,
                'semester' => 'ganjil',
                'quota' => 30,
            ],
            [
                'code' => 'IPA',
                'name' => 'Ilmu Pengetahuan Alam',
                'description' => 'Mata pelajaran yang mempelajari tentang alam dan lingkungan',
                'credits' => 4,
                'teacher_id' => 3,
                'semester' => 'ganjil',
                'quota' => 25,
            ],
            [
                'code' => 'IPS',
                'name' => 'Ilmu Pengetahuan Sosial',
                'description' => 'Mata pelajaran yang mempelajari tentang masyarakat dan budaya',
                'credits' => 3,
                'teacher_id' => 4,
                'semester' => 'ganjil',
                'quota' => 30,
            ],
            [
                'code' => 'BING',
                'name' => 'Bahasa Inggris',
                'description' => 'Mata pelajaran bahasa internasional',
                'credits' => 3,
                'teacher_id' => 5,
                'semester' => 'ganjil',
                'quota' => 30,
            ],
            [
                'code' => 'PAI',
                'name' => 'Pendidikan Agama Islam',
                'description' => 'Mata pelajaran pendidikan agama Islam',
                'credits' => 2,
                'teacher_id' => 8,
                'semester' => 'ganjil',
                'quota' => 30,
            ],
            [
                'code' => 'SENBUD',
                'name' => 'Seni Budaya',
                'description' => 'Mata pelajaran seni dan budaya',
                'credits' => 2,
                'teacher_id' => 6,
                'semester' => 'ganjil',
                'quota' => 25,
            ],
            [
                'code' => 'PJOK',
                'name' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan',
                'description' => 'Mata pelajaran olahraga dan kesehatan',
                'credits' => 2,
                'teacher_id' => 7,
                'semester' => 'ganjil',
                'quota' => 35,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}