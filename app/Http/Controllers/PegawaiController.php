<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\jabatan;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereDoesntHave('roles', function ($query) {
        $query->where('name', 'admin');
        })->get();
        return view('admin.pegawai.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $jabatan = jabatan::all();
        return view('admin.pegawai.create', compact('users','jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pegawai = new User();
        $pegawai->name = $request->name;
        $pegawai->email = $request->email;
        $pegawai->password = $request->password;
        $pegawai->id_jabatan = $request->id_jabatan;
        $pegawai->nip = $request->nip;
        $pegawai->telepon = $request->telepon;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->status_pegawai = 0;
        $pegawai->agama = $request->agama;
        $pegawai->alamat = $request->alamat;
    



        if ($request->hasFile('profile')){
            $img = $request->file('profile');
            $name = rand(1000,9999) . $img->getClientOriginalName();
            $img->move('images/pegawai', $name);
            $pegawai->profile = $name;
        }

        $pegawai->save();
        return redirect()->route('pegawai.index');
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
        //
    }
}
