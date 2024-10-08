<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::latest()
        //         ->leftJoin('sekolahs', 'npsn', '=', 'users.npsn')
        //         ->paginate(10);

    
        $users = User::select(

                "users.id", 

                "users.name",

                "users.email", 

                "sekolahs.nama_sekolah as nama_sekolah"

                        )

                ->leftJoin("sekolahs", "sekolahs.npsn", "=", "users.npsn")

                ->orderBy('name')

                ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $sekolahs = Sekolah::orderBy('nama_sekolah')->get();

        return view('users.create', compact('users','sekolahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npsn' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name'          => $request->name,
            'npsn'          => $request->npsn,
            'last_name'     => $request->name,
            'email'         => $request->email,
            'password'      => $request->password,
        ]);
        
        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'Operator Berhasil Ditambah!']);
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
        $users = User::select(

            "users.id", 

            "users.name",

            "users.email", 

            "users.npsn",

            "sekolahs.nama_sekolah as nama_sekolah"

                    )

            ->leftJoin("sekolahs", "sekolahs.npsn", "=", "users.npsn")
            ->findOrFail($id);
        $sekolahs = Sekolah::orderBy('nama_sekolah')->get();

        //render view with product
        return view('users.edit', compact('users', 'sekolahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate form
        $request->validate([
            'name'          => 'required',
            'email'         => 'required',
            'npsn'          => 'required',
        ]);
        $users = User::findOrFail($id);
        $users->name = $request->input('name');
        $users->last_name = $request->input('name');
        $users->email = $request->input('email');
        $users->npsn = $request->input('npsn');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $users->password)) {
                $users->password = $request->input('new_password');
            } else {
                return redirect()->back()->withInput();
            }
        }

        $users->save();

        return redirect()->route('users.index')->withSuccess('Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get dokumen by ID
        $users = User::findOrFail($id);

        //delete pegawai
        $users->delete();

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
