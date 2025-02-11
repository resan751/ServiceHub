<?php

namespace App\Http\Controllers;
Use App\Models\Barang;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BarangController extends Controller
{

  public function index(): view
  {
    $Barang = Barang::latest()->paginate(10);
    $Barang = Barang::orderBy('id_barang', 'asc')->get();

    $barang = Barang::select('nama_barang', 'stok')->get();

    return view('layout.barang', compact('Barang', 'barang'));
  }

    public function create(): View
    {
        return view('form.adbarang');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'stok' => $request->stok
        ]);

        return redirect('barang');
    }

    public function edit(string $id_barang): View
    {
        $Barang = Barang::findOrFail($id_barang);
        return view('form.upbarang', compact('Barang'));
    }

    public function Update(Request $request, $id_barang): RedirectResponse
    {
        $request->validate([
            'nama_barang' => 'required|min:5',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $Barang = Barang::findOrFail($id_barang);

        $Barang->Update([
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'stok' => $request->stok
        ]);

        return redirect()->route('barang.index');
    }

    public function destroy($id_barang): RedirectResponse
    {
        $Barang = Barang::findOrFail($id_barang);
        $Barang->delete();
        return back();
    }
}
