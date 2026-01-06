<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Validation\Rule;
use App\Models\Teacher;

class AdminSubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teacher')
                          ->orderBy('name')
                          ->paginate(15);

        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $teachers = Teacher::active()->orderBy('name')->get();
        
        // Daftar mata pelajaran standar untuk dropdown
        $standardSubjects = [
            ['code' => 'BIND', 'name' => 'Bahasa Indonesia'],
            ['code' => 'BING', 'name' => 'Bahasa Inggris'],
            ['code' => 'IPA', 'name' => 'Ilmu Pengetahuan Alam'],
            ['code' => 'IPS', 'name' => 'Ilmu Pengetahuan Sosial'],
            ['code' => 'MTK', 'name' => 'Matematika'],
            ['code' => 'PAI', 'name' => 'Pendidikan Agama Islam'],
            ['code' => 'SENBUD', 'name' => 'Seni Budaya'],
            ['code' => 'PJOK', 'name' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan'],
        ];
        
        return view('admin.subjects.create', compact('teachers', 'standardSubjects'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'code' => 'required|max:10',  // HAPUS Rule::unique
        'name' => 'required|max:255',
        'description' => 'nullable',
        'credits' => 'required|integer|min:1|max:10',
        'teacher_id' => 'nullable|exists:teachers,id',
        'semester' => 'required|in:ganjil,genap',
        'quota' => 'required|integer|min:1|max:100',
        'status' => 'required|in:active,inactive',
    ]);

    Subject::create($validated);

    return redirect()
        ->route('admin.subjects.index')
        ->with('success', 'Mata pelajaran berhasil ditambahkan!');
}

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $teachers = Teacher::active()->orderBy('name')->get();
        
        return view('admin.subjects.edit', compact('subject', 'teachers'));
    }

    public function update(Request $request, $id)
{
    $subject = Subject::findOrFail($id);
    
    $validated = $request->validate([
        'code' => 'required|max:10',  // HAPUS Rule::unique
        'name' => 'required|max:255',
        'description' => 'nullable',
        'credits' => 'required|integer|min:1|max:10',
        'teacher_id' => 'nullable|exists:teachers,id',
        'semester' => 'required|in:ganjil,genap',
        'quota' => 'required|integer|min:1|max:100',
        'status' => 'required|in:active,inactive',
    ]);

    $subject->update($validated);

    return redirect()
        ->route('admin.subjects.index')
        ->with('success', 'Mata pelajaran berhasil diupdate!');
}

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        
        // Check if subject has registrations
        if ($subject->registrations()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Tidak dapat menghapus mata pelajaran yang sudah memiliki registrasi!');
        }

        $subject->delete();

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil dihapus!');
    }
}