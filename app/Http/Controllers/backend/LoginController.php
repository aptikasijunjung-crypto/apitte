<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('backend.login');
    }

    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            if (!Auth::guard('admin')->attempt($validasi)) {
                return back()->with('error', 'Login Failed');
            }
            return redirect()->route('dashboard');
        } catch (ValidationException $e) {
        }
    }
}
