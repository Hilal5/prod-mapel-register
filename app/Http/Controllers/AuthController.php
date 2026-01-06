<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SchoolClass;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required',
        ], [
            'login.required' => 'NIS/Email/Nama wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');
        $remember = $request->filled('remember');

        // Tentukan field login (email, nis, atau name)
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Coba login dengan email
        if ($fieldType === 'email') {
            if (Auth::attempt(['email' => $login, 'password' => $password], $remember)) {
                $request->session()->regenerate();
                return $this->redirectUser();
            }
        } else {
            // Coba login dengan NIS atau Nama
            $user = User::where('nis', $login)
                        ->orWhere('name', $login)
                        ->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::login($user, $remember);
                $request->session()->regenerate();
                return $this->redirectUser();
            }
        }

        return back()->withErrors([
            'login' => 'NIS/Email/Nama atau password salah.',
        ])->onlyInput('login');
    }

    /**
     * Redirect user based on role
     */
    private function redirectUser()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/dashboard');
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        $classes = SchoolClass::active()->orderBy('name')->get();
        
        return view('auth.register', compact('classes'));
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:users,nis',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:L,P',
            'birth_date' => 'nullable|date',
            'class_id' => 'nullable|exists:classes,id',
            'address' => 'nullable|string',
            'terms' => 'accepted',
        ], [
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah terdaftar',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'gender.required' => 'Jenis kelamin wajib dipilih',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
        ]);

        $user = User::create([
            'nis' => $validated['nis'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'phone' => $validated['phone'] ?? null,
            'gender' => $validated['gender'],
            'birth_date' => $validated['birth_date'] ?? null,
            'class_id' => $validated['class_id'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        // Auto login after register
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Registrasi berhasil! Selamat datang di SIAKAD SMP.');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}