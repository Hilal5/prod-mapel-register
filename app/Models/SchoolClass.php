<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'grade',
        'room',
        'homeroom_teacher_id',
        'capacity',
        'status',
    ];

    /**
     * Wali kelas
     */
    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, 'homeroom_teacher_id');
    }

    /**
     * Siswa di kelas ini
     */
    public function students()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    /**
     * Jadwal kelas
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }

    /**
     * Scope untuk kelas aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope berdasarkan tingkat
     */
    public function scopeGrade($query, $grade)
    {
        return $query->where('grade', $grade);
    }

    /**
     * Hitung jumlah siswa
     */
    public function getStudentCountAttribute()
    {
        return $this->students()->count();
    }

    /**
     * Cek apakah kelas penuh
     */
    public function isFull()
    {
        return $this->student_count >= $this->capacity;
    }

    /**
     * Sisa kapasitas
     */
    public function getRemainingCapacityAttribute()
    {
        return max(0, $this->capacity - $this->student_count);
    }
}