<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        if (! session('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Check if user has admin role
        if (session('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied. Admin privileges required.');
        }

        return view('auth/admin_dashboard');
    }

    public function dashboard()
    {
        if (! session('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Check if user has admin role
        if (session('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied. Admin privileges required.');
        }

        return view('auth/admin_dashboard');
    }
}
