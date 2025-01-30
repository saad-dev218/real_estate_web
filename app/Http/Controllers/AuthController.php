<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

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

            if (!empty($responseData['errors'])) {
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

    public function log_in(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            // 'remember' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $response = Http::post($this->base_url . 'login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session(['token' => $data['token']]);

            return redirect()->route('home')->with('success', 'Login successful!');
        }

        $responseData = $response->json();
        return back()->with('error', $responseData['message'] ?? 'Invalid credentials. Please try again.');
    }

    public function logout() {}
}
