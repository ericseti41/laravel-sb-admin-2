<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->email == 'admin') {
            $siswas = Siswa::select(

                "siswas.nama",

                "siswas.id",

                "siswas.nik",

                "siswas.file", 

                "sekolahs.nama_sekolah as sekolah")
                ->leftJoin("sekolahs", "sekolahs.npsn", "=", "siswas.sekolah")
            ->orderBy('nama')->paginate(10);;
    
            return view('siswa.index', compact('siswas'));
        } else {
            $siswas = Siswa::select(

                "siswas.nama",

                "siswas.id",

                "siswas.nik",

                "siswas.file", 

                "sekolahs.nama_sekolah as sekolah"

                        )
                        ->leftJoin("sekolahs", "sekolahs.npsn", "=", "siswas.sekolah")
                        ->Where('sekolah', Auth::user()->npsn)
                        ->paginate(10);

            return view('siswa.index', compact('siswas'));
        }
    }

    public function awal()
    {
        $sekolahs = Sekolah::orderBy('nama_sekolah')->get();

        return view('welcome', compact('sekolahs'));
    }

	public function cari(Request $request)
	{
		// menangkap data pencarian
		$nama       = $request->nama;
        $nik        = $request->nik;
        $sekolah    = $request->sekolah;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$siswas = Siswa::latest()
		->where('nama','like',"%".$nama."%")
        ->where('nik', $nik)
        ->where('sekolah','like',"%".$sekolah."%")
        ->paginate(10);
 
    		// mengirim data pegawai ke view index
		return view('index', compact('siswas'));
 
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::select(

            "siswas.nama",
            
            "siswas.id",

            "siswas.nik",

            "siswas.file", 

            "siswas.nis", 

            "siswas.nisn",
            
            "siswas.tempat_lahir",

            "siswas.tgl_lahir",

            "siswas.ibu",

            "sekolahs.nama_sekolah as sekolah"

                    )
                    ->leftJoin("sekolahs", "sekolahs.npsn", "=", "siswas.sekolah")
                    ->Where('sekolah', Auth::user()->npsn)->get();
        $sekolahs = Sekolah::orderBy('nama_sekolah')->get();

        return view('siswa.create', compact('siswas','sekolahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->email == 'admin'){
        //validate form
        $request->validate([
            'nama'          => 'required',
            'nik'           => ['required','unique:siswas'],
            'nis'           => 'required',
            'nisn'          => ['required','unique:siswas'],
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'date',
            'ibu'           => 'required',
            'npsn'          => 'required',
            'file'          => "required|mimes:pdf|max:10000",
        ]);

        $file = $request->file('file');
        $namadokumen = $request->nik.'_'.$request->nama.'.'.$file->getClientOriginalName();
        $file->storeAs('public/dokumen', $namadokumen);

        //create dokumen
        Siswa::create([
            'nik'           => $request->nik,
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'nisn'          => $request->nisn,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'ibu'           => $request->ibu,
            'sekolah'       => $request->npsn,
            'file'          => $namadokumen,
        ]);

        //redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Ditambah!']);
    } else {

        //validate form
        $request->validate([
            'nama'          => 'required',
            'nik'           => ['required','unique:siswas'],
            'nis'           => 'required',
            'nisn'          => ['required','unique:siswas'],
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'date',
            'ibu'           => 'required',
            'file'          => 'required|mimes:pdf|max:800',
        ]);

        $file = $request->file('file');
        $namadokumen = $request->nik.'_'.$request->nama.'.'.$file->getClientOriginalName();
        $file->storeAs('public/dokumen', $namadokumen);

        //create dokumen
        Siswa::create([
            'nik'           => $request->nik,
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'nisn'          => $request->nisn,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'ibu'           => $request->ibu,
            'sekolah'       => Auth::user()->npsn,
            'file'          => $namadokumen,
        ]);

        //redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Ditambah!']);

    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get product by ID
        $siswa = Siswa::select(            
            "siswas.nama",
            
            "siswas.id",

            "siswas.nik",

            "siswas.file", 

            "siswas.nis", 

            "siswas.nisn",
            
            "siswas.tempat_lahir",

            "siswas.tgl_lahir",

            "siswas.ibu",

            "sekolahs.nama_sekolah as sekolah")
                    ->leftJoin("sekolahs", "sekolahs.npsn", "=", "siswas.sekolah")
                    ->findOrFail($id);

        //render view with product
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Siswa::select(            
            "siswas.nama",
            
            "siswas.id",

            "siswas.nik",

            "siswas.file", 

            "siswas.nis", 

            "siswas.nisn",
            
            "siswas.tempat_lahir",

            "siswas.tgl_lahir",

            "siswas.ibu",

            "sekolahs.nama_sekolah as sekolah")
                    ->leftJoin("sekolahs", "sekolahs.npsn", "=", "siswas.sekolah")
                    ->findOrFail($id);
        $sekolahs = Sekolah::orderBy('nama_sekolah')->get();

        //render view with product
        return view('siswa.edit', compact('data','sekolahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'nama'          => 'required',
            'nik'           => 'required',
            'nis'           => 'required',
            'nisn'          => 'required',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'date',
            'ibu'           => 'required',
        ]);

        $siswas = Siswa::findOrFail($id);

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $namadokumen = $request->nik.'_'.$request->nama.'.'.$file->getClientOriginalName();
            $file->storeAs('public/dokumen', $namadokumen);


            //delete old image
            Storage::delete('public/dokumen/'.$namadokumen);

            $siswas->update([
            'nik'           => $request->nik,
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'nisn'          => $request->nisn,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'ibu'           => $request->ibu,
            'sekolah'       => Auth::user()->npsn,
            'file'          => $namadokumen,
            ]);
        
        } else {

            $siswas->update([
            'nik'           => $request->nik,
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'nisn'          => $request->nisn,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'ibu'           => $request->ibu,
            'sekolah'       => Auth::user()->npsn,
            ]);
        }

        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get dokumen by ID
        $siswas = Siswa::findOrFail($id);

        //delete pegawai
        $siswas->delete();

        //redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
