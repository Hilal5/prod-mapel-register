<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of schedules.
     */
    public function index(Request $request)
{
    $user = Auth::user();
    $studentGrade = $user->class ? $user->class->grade : null;

    $query = Schedule::with(['subject', 'schoolClass', 'teacher']);

    if ($studentGrade && !$request->filled('class')) {
        $query->whereHas('schoolClass', function($q) use ($studentGrade) {
            $q->where('grade', $studentGrade);
        });
    }

    if ($request->filled('class')) {
        $query->where('class_id', $request->class);
    }

    if ($request->filled('day')) {
        $query->where('day', $request->day);
    }

    // UBAH bagian ini
    if ($request->filled('subject_id')) {
        $query->where('subject_id', $request->subject_id);
    }

    $schedules = $query->orderBy('day')
                       ->orderBy('start_time')
                       ->paginate(20);

    $classes = SchoolClass::active()
        ->when($studentGrade, function($q) use ($studentGrade) {
            $q->where('grade', $studentGrade);
        })
        ->orderBy('name')
        ->get();

    // TAMBAH ini
    $subjects = Subject::active()->orderBy('name')->get();

    return view('schedules.index', compact('schedules', 'classes', 'subjects'));
}

    /**
     * Display schedules by class.
     */
    public function byClass($classId)
    {
        $class = SchoolClass::findOrFail($classId);
        
        $schedules = Schedule::with(['subject', 'teacher'])
                            ->where('class_id', $classId)
                            ->where('semester', 'ganjil')
                            ->where('academic_year', 2025)
                            ->orderBy('day')
                            ->orderBy('start_time')
                            ->get();

        return view('schedules.by-class', compact('schedules', 'class'));
    }

    /**
     * Display schedules by day.
     */
    public function byDay($day)
    {
        // ✅ FIXED: 'class' → 'schoolClass'
        $schedules = Schedule::with(['subject', 'schoolClass', 'teacher'])
                            ->where('day', $day)
                            ->where('semester', 'ganjil')
                            ->where('academic_year', 2025)
                            ->orderBy('start_time')
                            ->get();

        return view('schedules.by-day', compact('schedules', 'day'));
    }
}