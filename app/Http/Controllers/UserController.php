<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya pengguna terautentikasi yang bisa akses
    }

    public function dashboarduser()
    {
        $data = [
            'title' => 'Data User',
            'menuAdminUser' => 'active',
            'user' => User::get(),
        ];

        return view('user.dashboard', $data);
    }
}
