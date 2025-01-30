<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public $base_url;
    public function __construct()
    {
        $this->base_url = env('BASE_URL');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function registeration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        $response = Http::post($this->base_url . 'register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
        }

        if ($response->failed()) {
            $responseData = $response->json();

            if (isset($responseData['errors'])) {
                return redirect()->route('register')->withErrors($responseData['errors'])->withInput();
            }

            return back()->with('error', $responseData['message'] ?? 'Registration failed. Please try again.');
        }

        return back()->with('error', 'Something went wrong. Please try again.');
    }


    public function login()
    {
        return view('auth.login');
    }
}
