<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard untuk Admin.
     */
    public function admin(): View
    {
        return view('dashboard', [
            'roleLabel' => 'Administrator',
            'user' => Auth::user(),
        ]);
    }

    /**
     * Tampilkan halaman dashboard untuk HR.
     */
    public function hr(): View
    {
        return view('dashboard', [
            'roleLabel' => 'Human Resource',
            'user' => Auth::user(),
        ]);
    }

    /**
     * Tampilkan halaman dashboard untuk Employee.
     */
    public function employee(): View
    {
        return view('dashboard', [
            'roleLabel' => 'Karyawan',
            'user' => Auth::user(),
        ]);
    }
}
