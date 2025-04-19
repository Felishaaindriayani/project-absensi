<?php
namespace App\Http\Controllers;

use App\Models\jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        $jabatan = Jabatan::all();
        return view('admin.pegawai.index', compact('pegawai', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = User::all();
        $jabatan = jabatan::all();
        return view('admin.pegawai.create', compact('pegawai', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pegawai                 = new User();
        $pegawai->name           = $request->name;
        $pegawai->email          = $request->email;
        $pegawai->password       = Hash::make($request->password); // jangan lupa hash password ya!
        $pegawai->id_jabatan     = $request->id_jabatan;
        $pegawai->nip            = $request->nip;
        $pegawai->telepon        = $request->telepon;
        $pegawai->jenis_kelamin  = $request->jenis_kelamin;
        $pegawai->tempat_lahir   = $request->tempat_lahir;
        $pegawai->tgl_lahir      = $request->tgl_lahir;
        $pegawai->status_pegawai = 0;
        $pegawai->agama          = $request->agama;
        $pegawai->alamat         = $request->alamat;

        if ($request->hasFile('profile')) {
            $img  = $request->file('profile');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/pegawai', $name);
            $pegawai->profile = $name;
        }

        $pegawai->save();

        // ✅ Tambahin ini biar langsung dapet role "user"
        $pegawai->assignRole('user');

        return redirect()->route('pegawai.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pegawai = User::findOrFail($id);
        $jabatan = Jabatan::all();
        return view('admin.pegawai.show', compact('pegawai', 'jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pegawai = User::findOrFail($id);
        $jabatan = jabatan::all();
        return view('admin.pegawai.edit', compact('pegawai', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pegawai                 = User::findOrFail($id);
        $pegawai->name           = $request->name;
        $pegawai->email          = $request->email;
        $pegawai->password       = $request->password;
        $pegawai->id_jabatan     = $request->id_jabatan;
        $pegawai->nip            = $request->nip;
        $pegawai->telepon        = $request->telepon;
        $pegawai->jenis_kelamin  = $request->jenis_kelamin;
        $pegawai->tempat_lahir   = $request->tempat_lahir;
        $pegawai->tgl_lahir      = $request->tgl_lahir;
        $pegawai->status_pegawai = $request->status_pegawai;
        $pegawai->agama          = $request->agama;
        $pegawai->alamat         = $request->alamat;

        if ($request->hasFile('profile')) {
            $img  = $request->file('profile');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/pegawai', $name);
            $pegawai->profile = $name;
        }

        $pegawai->save();
        return redirect()->route('pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = User::find($id);

        if (! $pegawai) {
            return redirect()->route('pegawai.index')->with('danger', 'Pegawai tidak ditemukan!');
        }

        if (Auth::user()->id !== $pegawai->id) {
            $pegawai->delete();
            return redirect()->route('pegawai.index')->with('danger', 'pegawai berhasil dihapus!');
        }

        return redirect()->route('pegawai.index')->with('danger', 'Anda tidak bisa menghapus diri sendiri!');

    }

}
