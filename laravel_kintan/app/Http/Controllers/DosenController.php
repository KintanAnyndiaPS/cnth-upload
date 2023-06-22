<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Dosen::latest()->paginate(10);
        return view('dosen.index', compact('dosen'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/dosen', $gambar->hashName());
        $dosen = Dosen::create([
            'nama' => $request->nama,
            'gambar' => $gambar->hashName(),
            'nip' => $request->nip,
            'prodi' => $request->prodi,
            'kompetensi' => $request->kompetensi,
        ]);
        if ($dosen) {
            return redirect()->route('dosen.index')->with(['success' => 'Data Berhasil di Simpan']);
        } else {
            return redirect()->route('dosen.index')->with(['error' => 'Data Gagal di Simpan']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dosen = Dosen::find($id);
        return view('dosen.update', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        if ($request->file('gambar') == "") {
            $dosen->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'prodi' => $request->prodi,
                'kompetensi' => $request->kompetensi,

            ]);
        } else {
            Storage::disk('local')->delete('public/dosen/' . $dosen->gambar);
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/dosen', $gambar->hashName());
            $dosen->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'prodi' => $request->prodi,
                'kompetensi' => $request->kompetensi,
                'gambar' => $gambar->hashName(),
            ]);
        }
        if ($dosen) {
            return redirect()->route('dosen.index')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            return redirect()->route('dosen.index')->with(['error' => 'Data Gagal Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        Storage::disk('local')->delete('public/dosen/' . $dosen->gambar);
        $dosen->delete();
        if ($dosen) {
            return redirect()->route('dosen.index')->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect()->route('dosen.index')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
