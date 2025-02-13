<?php

namespace App\Http\Controllers;
Use App\Models\Detail;
Use App\Models\Barang;
Use App\Models\jasa;
Use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $Barang = Barang::latest()->paginate(20);
        $Jasa = Jasa::latest()->paginate(20);
        return view('form.detail' , compact('Barang', 'Jasa'));

    }
    public function create(): View
    {
        return view('form.detail');
    }


}
