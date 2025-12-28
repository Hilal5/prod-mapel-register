<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'schedule_id',
        'status',
        'registration_date',
        'notes',
    ];

    protected $casts = [
        'registration_date' => 'date',
    ];

    /**
     * Siswa yang mendaftar
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mata pelajaran
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Jadwal
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Scope untuk status tertentu
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk registrasi aktif (approved)
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope untuk registrasi pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope untuk siswa tertentu
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Approve registrasi
     */
    public function approve()
    {
        $this->update(['status' => 'approved']);
    }

    /**
     * Reject registrasi
     */
    public function reject()
    {
        $this->update(['status' => 'rejected']);
    }

    /**
     * Cancel registrasi
     */
    public function cancel()
    {
        $this->update(['status' => 'cancelled']);
    }

    /**
     * Check if approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }
}