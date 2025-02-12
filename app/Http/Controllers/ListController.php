<?php

namespace App\Http\Controllers;

Use App\Models\Barang;
Use App\Models\Jasa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(): view
    {
        $Barang = Barang::latest()->paginate(10);
        $Barang = Barang::orderBy('id_barang', 'asc')->get();

        $Jasa = Jasa::latest()->paginate(10);
        $Jasa = Jasa::orderBy('id_jasa', 'asc')->get();

        return view('layout.list', compact('Jasa', 'Barang'));
    }

    public function back()
    {
        return redirect()->back();
    }
}
