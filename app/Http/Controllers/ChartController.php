<?php

namespace App\Http\Controllers;
Use App\models\User;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function chart()
    {
       // Hitung jumlah Admin dan User
       $adminCount = User::where('role', 'admin')->count();
       $userCount = User::where('role', 'user')->count();

        return view('layout.dashboard', compact('adminCount', 'userCount'));
    }
}
