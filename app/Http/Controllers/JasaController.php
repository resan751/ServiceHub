<?php

namespace App\Http\Controllers;
Use App\Models\jasa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class JasaController extends Controller
{
    public function index(Request $request): View
    {
        $query = $request->input('search');
        if ($query) {
            $Jasa = jasa::where('nama_jasa', 'like', "%$query%")
                ->orderBy('id_jasa', 'asc')
                ->get();
        } else {
            $Jasa = jasa::orderBy('id_jasa', 'asc')->get();
        }
        return view('layout.jasa', compact('Jasa','query'));
    }

  public function create(): View
  {
    return view('form.adjasa');
  }

  public function store(Request $request): RedirectResponse
  {
    $request->validate([
        'nama_jasa' => 'required',
        'harga_jasa' => 'required|numeric'
    ]);

    Jasa::create([
        'nama_jasa' => $request->nama_jasa,
        'harga_jasa' => $request->harga_jasa
    ]);

    return redirect('jasa');
  }

  public function edit(string $id_jasa): View
  {
    $Jasa = Jasa::findOrFail($id_jasa);
    return view('form.upjasa', compact('Jasa'));
  }

  public function update(Request $request, $id_jasa): RedirectResponse
  {
    $request->validate([
        'nama_jasa' => 'required|min:5',
        'harga_jasa' => 'required|numeric'
    ]);

    $Jasa = Jasa::findOrFail($id_jasa);

    $Jasa->update([
        'nama_jasa' => $request->nama_jasa,
        'harga_jasa' => $request->harga_jasa
    ]);

    return redirect()->route('jasa.index');
  }

  public function destroy($id_jasa): RedirectResponse
    {
        $Jasa = jasa::findOrFail($id_jasa);
        $Jasa->delete();
        return back();
    }

  public function getHarga($id)
  {
    $jasa = Jasa::findOrFail($id);
    return response()->json(['harga_jasa' => $jasa->harga_jasa]);
  }

}
