<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AppController extends Controller
{
    public function show() {
        
        $wordle = $this->getWordle();
        $nerdle = $this->getNerdle();

        // If user is logged in
        if (Auth::user()) {
            Auth::user()->canSubmitWordle = Auth::user()->wordleEntry()->where('date', date("Y-m-d"))->get()->isEmpty();
            Auth::user()->canSubmitNerdle = Auth::user()->nerdleEntry()->where('date', date("Y-m-d"))->get()->isEmpty();
        }
        
        return view('app', [
            'wordle' => $wordle,
            'nerdle' => $nerdle,
        ]);
    }

    public function signup(Request $request) {

        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'max:255']
        ])->validateWithBag('signup');
        
        // Create new User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        
        return redirect('/');
    }

    public function login(Request $request) {

        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ])->validateWithBag('login');
        
        // Attempt to login
        if (Auth::attempt($validator, true)) {
            $request->session()->regenerate();
            return redirect()->back();
        }
        
        // Unsuccessful login
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ], 'login');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    private function getWordle() {
        $users = User::all();
        foreach ($users as $user) {
            $attemptsSum = $user->wordleEntry->sum('attempts');
            $count = $user->wordleEntry->count();
            $user->points = ($count * 7) - $attemptsSum;
        }
        return $users->sortByDesc('points');
    }

    private function getNerdle() {
        $users = User::all();
        foreach ($users as $user) {
            $attemptsSum = $user->nerdleEntry->sum('attempts');
            $count = $user->nerdleEntry->count();
            $user->points = ($count * 7) - $attemptsSum;
        }
        return $users->sortByDesc('points');
    }
}
