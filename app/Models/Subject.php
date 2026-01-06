<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'credits',
        'teacher_id',
        'semester',
        'quota',
        'status',
    ];

    /**
     * Guru pengampu mata pelajaran
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Jadwal mata pelajaran
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Registrasi siswa
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Siswa yang terdaftar
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'registrations')
                    ->withPivot('status', 'registration_date', 'notes')
                    ->withTimestamps();
    }

    /**
     * Scope untuk mata pelajaran aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope berdasarkan semester
     */
    public function scopeSemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }

    /**
     * Hitung jumlah siswa terdaftar
     */
    public function getRegisteredCountAttribute()
    {
        return $this->registrations()->where('status', 'approved')->count();
    }

    /**
     * Cek apakah kuota penuh
     */
    public function isQuotaFull()
    {
        return $this->registered_count >= $this->quota;
    }

    /**
     * Sisa kuota
     */
    public function getRemainingQuotaAttribute()
    {
        return max(0, $this->quota - $this->registered_count);
    }
}