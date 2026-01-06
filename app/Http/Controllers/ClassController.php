<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;

class ClassController extends Controller
{
    /**
     * Display a listing of classes.
     */
    public function index()
    {
        $classes = SchoolClass::with('homeroomTeacher')
                             ->withCount('students')
                             ->where('status', 'active')
                             ->orderBy('grade')
                             ->orderBy('name')
                             ->get();

        return view('classes.index', compact('classes'));
    }

    /**
     * Display the specified class.
     */
    public function show($id)
    {
        $class = SchoolClass::with([
                                'homeroomTeacher', 
                                'students', 
                                'schedules' => function($query) {
                                    $query->with(['subject.teacher'])
                                          ->orderBy('day')
                                          ->orderBy('start_time');
                                }
                            ])
                           ->withCount('students')
                           ->findOrFail($id);

        return view('classes.show', compact('class'));
    }

    /**
     * Display students in a class.
     */
    public function students($id)
    {
        $class = SchoolClass::with(['students' => function($query) {
                                $query->orderBy('name');
                            }])
                           ->findOrFail($id);

        return view('classes.students', compact('class'));
    }
}