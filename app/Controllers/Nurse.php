<?php

namespace App\Controllers;

class Nurse extends BaseController
{
	public function index()
	{
		if (! session('isLoggedIn')) {
			return redirect()->to('/login');
		}

		// Check if user has nurse role
		if (session('role') !== 'nurse') {
			return redirect()->to('/login')->with('error', 'Access denied. Nurse privileges required.');
		}

		return view('auth/nurse_dashboard');
	}
}

?>

