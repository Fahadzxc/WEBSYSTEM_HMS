<?php

namespace App\Controllers;

class Receptionist extends BaseController
{
	public function index()
	{
		if (! session('isLoggedIn')) {
			return redirect()->to('/login');
		}

		// Check if user has receptionist role
		if (session('role') !== 'receptionist') {
			return redirect()->to('/login')->with('error', 'Access denied. Receptionist privileges required.');
		}


		return view('auth/receptionist_dashboard');
	}

	public function patients()
	{
		if (! session('isLoggedIn')) return redirect()->to('/login');
		if (session('role') && session('role') !== 'receptionist') return redirect()->to('/dashboard');
		return view('auth/receptionist_patients');
	}

	public function appointments()
	{
		if (! session('isLoggedIn')) return redirect()->to('/login');
		if (session('role') && session('role') !== 'receptionist') return redirect()->to('/dashboard');
		return view('auth/receptionist_appointments');
	}

	public function reports()
	{
		if (! session('isLoggedIn')) return redirect()->to('/login');
		if (session('role') && session('role') !== 'receptionist') return redirect()->to('/dashboard');
		return view('auth/receptionist_reports');
	}

	public function settings()
	{
		if (! session('isLoggedIn')) return redirect()->to('/login');
		if (session('role') && session('role') !== 'receptionist') return redirect()->to('/dashboard');
		return view('auth/receptionist_settings');
	}
}

?>


