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
            'password' => 'required|min:8',
            'remember' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        try {
            $remember = $request->has('remember') && $request->remember == 'on';

            $response = Http::post($this->base_url . 'login', [
                'email' => $request->email,
                'password' => $request->password,
                'remember' => $remember,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $user_details = $data['data']['user_details']['user'];
                $token = $data['data']['user_details']['token'];
                session()->put('authenticated', true);
                session()->put('token', $token);
                session()->put('user', $user_details);

                return redirect()->route('home')->with('success', 'Login successful!');
            }
            $responseData = $response->json();
            return back()->with('error', $responseData['message'] ?? 'Invalid credentials. Please try again.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while logging in. Please try again later.');
        }
    }



    public function logout(Request $request)
    {
        try {
            $token = session('token');
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($token) {
                $response = Http::withToken($token)->post($this->base_url . 'logout');

                if ($response->successful()) {
                    session()->forget('token');
                    session()->forget('user');
                    session()->put('authenticated', false);
                } else {
                    return back()->with('error', 'Failed to log out from the API.');
                }
            }

            return redirect()->route('login')->with('success', 'Logout successful');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred during logout. Please try again later.');
        }
    }


    public function user()
    {
        try {
            $token = session('token');

            if (!$token) {
                return redirect()->route('login')->with('error', 'Please login first.');
            }

            $response = Http::withToken($token)->get($this->base_url . 'getuser');

            if ($response->successful()) {
                $data = $response->json();
                // Save user data in session
                session(['user' => $data]);
            }

            return redirect()->route('login')->with('error', 'Failed to fetch user details. Please try again.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while fetching user details. Please try again later.');
        }
    }
}
