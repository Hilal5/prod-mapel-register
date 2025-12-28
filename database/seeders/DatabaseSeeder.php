<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan seeding penting karena foreign key constraints
        $this->call([
            TeacherSeeder::class,
            SchoolClassSeeder::class,
            SubjectSeeder::class,
            ScheduleSeeder::class,
            UserSeeder::class,
            RegistrationSeeder::class,
        ]);

        $this->command->info('✅ Database seeded successfully!');
    }
}