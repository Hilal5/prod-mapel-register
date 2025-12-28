<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis',
        'name',
        'email',
        'password',
        'role',
        'class_id',
        'phone',
        'address',
        'gender',
        'birth_date',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
        ];
    }

    /**
     * Kelas siswa
     */
    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Registrasi mata pelajaran
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Mata pelajaran yang diambil
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'registrations')
                    ->withPivot('status', 'registration_date', 'notes')
                    ->withTimestamps();
    }

    /**
     * Scope untuk admin
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope untuk siswa
     */
    public function scopeStudent($query)
    {
        return $query->where('role', 'student');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is student
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Get approved registrations
     */
    public function approvedRegistrations()
    {
        return $this->registrations()->where('status', 'approved');
    }
}