<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekolahs = Sekolah::orderBy('nama_sekolah')->paginate(10);

        return view('sekolah.index', compact('sekolahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'npsn' => 'required',
            'nama_sekolah' => 'required',
        ]);

        //create dokumen
        Sekolah::create([
            'npsn' => $request->npsn,
            'nama_sekolah' => $request->nama_sekolah,
        ]);

        //redirect to index
        return redirect()->route('sekolah.index')->with(['success' => 'Nama Sekolah Berhasil Ditambah!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get pegawai by ID
        $sekolahs = Sekolah::findOrFail($id);

        //delete pegawai
        $sekolahs->delete();

        //redirect to index
        return redirect()->route('sekolah.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
