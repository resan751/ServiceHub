<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\User;
use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Service;
use App\Models\Servis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $services = Service::with(['user', 'details.barang', 'details.jasa'])->get();
    return view('layout.list', compact('services'));
    }
}
