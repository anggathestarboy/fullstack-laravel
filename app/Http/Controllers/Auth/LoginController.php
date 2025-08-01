<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $validasi = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validasi)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->isadmin) {
                return redirect('/admin'); // -> pages.admin.dashboard
            } else {
                return redirect('/student'); // -> pages.user.home
            }
            // return redirect('/');
        }

        return back()->withErrors(['login' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

  
}
