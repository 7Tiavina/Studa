<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        $subjects = Subject::all();
        return view('register', compact('subjects'));
    }

    public function register(Request $request)
    {
        \Log::info('Tentative d\'inscription démarrée.', $request->all());

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:student,teacher,admin',
                'subject_id' => 'nullable|required_if:role,teacher|exists:subjects,id',
            ]);
            \Log::info('Validation réussie.', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Erreur de validation lors de l\'inscription.', $e->errors());
            throw $e;
        }

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);
            \Log::info('Utilisateur créé avec succès.', ['id' => $user->id]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de l\'utilisateur.', ['message' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Erreur lors de la création du compte.']);
        }

        if ($user->role === 'teacher' && $request->filled('subject_id')) {
            $user->subjects()->attach($request->subject_id);
            \Log::info('Matière attachée au professeur.');
        }

        Auth::login($user);
        \Log::info('Utilisateur connecté.');

        return $this->redirectByRole($user->role);
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Cet e-mail n\'est pas enregistré dans le système.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user()->role);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['password' => 'Le mot de passe est incorrect.']);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->update(['last_seen_at' => now()->subMinutes(10)]);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function redirectByRole($role)
    {
        $path = '/dashboard/' . $role;
        \Log::info('Redirecting user to: ' . $path);
        return redirect($path);
    }
}
