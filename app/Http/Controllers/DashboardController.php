<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\Registration;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $studentGrade = $user->class ? $user->class->grade : null;

        // Ambil data real dari database
        $data = [
            'totalSubjects' => Subject::active()->count(),
            'totalClasses' => SchoolClass::active()->count(),
            'totalStudents' => User::student()->count(),
            'activeRegistrations' => Registration::where('status', 'approved')->count(),
            'todaySchedules' => Schedule::where('day', $this->getTodayInIndonesian())
                                ->with(['subject', 'teacher', 'schoolClass'])
                                ->when($studentGrade, function($query) use ($studentGrade) {
                                    $query->whereHas('schoolClass', function($q) use ($studentGrade) {
                                        $q->where('grade', $studentGrade);
                                    });
                                })
                                ->orderBy('start_time')
                                ->limit(5)
                                ->get(),
        ];

        return view('dashboard', $data);
    }

    /**
     * Get today's day name in Indonesian
     */
    private function getTodayInIndonesian()
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        return $days[now()->format('l')] ?? 'Senin';
    }
}