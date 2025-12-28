<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'birth_date',
        'photo',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Mata pelajaran yang diajar guru ini
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * Jadwal mengajar
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Kelas yang menjadi wali kelas
     */
    public function homeroomClass()
    {
        return $this->hasOne(SchoolClass::class, 'homeroom_teacher_id');
    }

    /**
     * Scope untuk guru aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get full name with title
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }
}