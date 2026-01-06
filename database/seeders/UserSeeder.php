<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@smp.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'gender' => 'L',
        ]);

         $students = [
            // Kelas VII
            ['nis' => '24001', 'name' => 'Ahmad Fauzi', 'email' => 'ahmad.fauzi@student.smp.sch.id', 'class_id' => 1, 'gender' => 'L', 'birth_date' => '2012-03-12'],
            ['nis' => '24002', 'name' => 'Siti Aisyah', 'email' => 'siti.aisyah@student.smp.sch.id', 'class_id' => 2, 'gender' => 'P', 'birth_date' => '2012-07-21'],
            ['nis' => '24003', 'name' => 'Rizky Pratama', 'email' => 'rizky.pratama@student.smp.sch.id', 'class_id' => 3, 'gender' => 'L', 'birth_date' => '2012-10-05'],
            ['nis' => '24004', 'name' => 'Nabila Putri', 'email' => 'nabila.putri@student.smp.sch.id', 'class_id' => 4, 'gender' => 'P', 'birth_date' => '2012-01-18'],
            ['nis' => '24005', 'name' => 'Andi Saputra', 'email' => 'andi.saputra@student.smp.sch.id', 'class_id' => 5, 'gender' => 'L', 'birth_date' => '2012-09-09'],
            ['nis' => '24006', 'name' => 'Putri Amelia', 'email' => 'putri.amelia@student.smp.sch.id', 'class_id' => 6, 'gender' => 'P', 'birth_date' => '2012-11-30'],
            
            // Kelas VIII
            ['nis' => '24007', 'name' => 'Dimas Pratama', 'email' => 'dimas.pratama@student.smp.sch.id', 'class_id' => 7, 'gender' => 'L', 'birth_date' => '2011-02-14'],
            ['nis' => '24008', 'name' => 'Aulia Rahma', 'email' => 'aulia.rahma@student.smp.sch.id', 'class_id' => 8, 'gender' => 'P', 'birth_date' => '2011-05-22'],
            ['nis' => '24009', 'name' => 'Fajar Maulana', 'email' => 'fajar.maulana@student.smp.sch.id', 'class_id' => 9, 'gender' => 'L', 'birth_date' => '2011-08-08'],
            ['nis' => '24010', 'name' => 'Nanda Putri', 'email' => 'nanda.putri@student.smp.sch.id', 'class_id' => 10, 'gender' => 'P', 'birth_date' => '2011-03-16'],
            ['nis' => '24011', 'name' => 'Reza Akbar', 'email' => 'reza.akbar@student.smp.sch.id', 'class_id' => 11, 'gender' => 'L', 'birth_date' => '2011-12-27'],
            ['nis' => '24012', 'name' => 'Salsabila Zahra', 'email' => 'salsabila.zahra@student.smp.sch.id', 'class_id' => 12, 'gender' => 'P', 'birth_date' => '2011-06-01'],
            
            // Kelas IX
            ['nis' => '24013', 'name' => 'Muhammad Iqbal', 'email' => 'muhammad.iqbal@student.smp.sch.id', 'class_id' => 13, 'gender' => 'L', 'birth_date' => '2010-04-11'],
            ['nis' => '24014', 'name' => 'Annisa Putri', 'email' => 'annisa.putri@student.smp.sch.id', 'class_id' => 14, 'gender' => 'P', 'birth_date' => '2010-07-19'],
            ['nis' => '24015', 'name' => 'Rian Prakoso', 'email' => 'rian.prakoso@student.smp.sch.id', 'class_id' => 15, 'gender' => 'L', 'birth_date' => '2010-02-02'],
            ['nis' => '24016', 'name' => 'Zahra Aulia', 'email' => 'zahra.aulia@student.smp.sch.id', 'class_id' => 16, 'gender' => 'P', 'birth_date' => '2010-09-25'],
            ['nis' => '24017', 'name' => 'Aldi Ramadhan', 'email' => 'aldi.ramadhan@student.smp.sch.id', 'class_id' => 17, 'gender' => 'L', 'birth_date' => '2010-06-06'],
            ['nis' => '24018', 'name' => 'Nabila Khairunnisa', 'email' => 'nabila.khairunnisa@student.smp.sch.id', 'class_id' => 18, 'gender' => 'P', 'birth_date' => '2010-11-29'],
        ];

        foreach ($students as $student) {
            User::create([
                'nis' => $student['nis'],
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make('password'), // Default password: password
                'role' => 'student',
                'class_id' => $student['class_id'],
                'gender' => $student['gender'],
                'birth_date' => $student['birth_date'],
                'phone' => '0812' . str_pad($student['nis'], 8, '0', STR_PAD_LEFT),
                'address' => 'Kisaran, Sumatera Utara',
            ]);
        }
    }
}