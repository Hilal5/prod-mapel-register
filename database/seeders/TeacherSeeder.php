<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            [
                'nip' => '198501012010011001',
                'name' => 'Budi Santoso, S.Pd',
                'email' => 'budi@smp.sch.id',
                'phone' => '081234567801',
                'address' => 'Jl. Pendidikan No. 1, Medan',
                'gender' => 'L',
                'birth_date' => '1985-01-01',
                'status' => 'active',
            ],
            [
                'nip' => '198602152011012001',
                'name' => 'Siti Aminah, S.Pd',
                'email' => 'siti@smp.sch.id',
                'phone' => '081234567802',
                'address' => 'Jl. Guru No. 2, Medan',
                'gender' => 'P',
                'birth_date' => '1986-02-15',
                'status' => 'active',
            ],
            [
                'nip' => '198703202012011002',
                'name' => 'Ahmad Yani, S.Pd',
                'email' => 'ahmad@smp.sch.id',
                'phone' => '081234567803',
                'address' => 'Jl. Ilmu No. 3, Medan',
                'gender' => 'L',
                'birth_date' => '1987-03-20',
                'status' => 'active',
            ],
            [
                'nip' => '198804102013012001',
                'name' => 'Dewi Lestari, S.Pd',
                'email' => 'dewi@smp.sch.id',
                'phone' => '081234567804',
                'address' => 'Jl. Sosial No. 4, Medan',
                'gender' => 'P',
                'birth_date' => '1988-04-10',
                'status' => 'active',
            ],
            [
                'nip' => '198905252014011001',
                'name' => 'John Anderson, S.Pd',
                'email' => 'john@smp.sch.id',
                'phone' => '081234567805',
                'address' => 'Jl. Bahasa No. 5, Medan',
                'gender' => 'L',
                'birth_date' => '1989-05-25',
                'status' => 'active',
            ],
            [
                'nip' => '199006122015012001',
                'name' => 'Rina Wati, S.Ag',
                'email' => 'rina@smp.sch.id',
                'phone' => '081234567806',
                'address' => 'Jl. Agama No. 6, Medan',
                'gender' => 'P',
                'birth_date' => '1990-06-12',
                'status' => 'active',
            ],
            [
                'nip' => '199107182016011001',
                'name' => 'Joko Susilo, S.Pd',
                'email' => 'joko@smp.sch.id',
                'phone' => '081234567807',
                'address' => 'Jl. Olahraga No. 7, Medan',
                'gender' => 'L',
                'birth_date' => '1991-07-18',
                'status' => 'active',
            ],
            [
                'nip' => '199208302017012001',
                'name' => 'Hasan Basri, S.Ag',
                'email' => 'hasan@smp.sch.id',
                'phone' => '081234567808',
                'address' => 'Jl. Pendidikan No. 8, Medan',
                'gender' => 'L',
                'birth_date' => '1992-08-30',
                'status' => 'active',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}