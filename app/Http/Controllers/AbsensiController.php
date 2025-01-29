<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\absensi;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::all();
        return view('admin.absensi.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $absensi = Absensi::all();
        $pegawai = User::all();
        return view('admin.absensi.create', compact('absensi', 'pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $absensi             = new Absensi();
        $absensi->id_user    = $request->id_user;
        $absensi->tanggal    = $request->tanggal;
        $absensi->jam_masuk  = $request->jam_masuk;
        $absensi->jam_keluar = $request->jam_keluar;
        $absensi->status     = 'Hadir';
        $absensi->jam_kerja  = $request->jam_kerja;

        $absensi->save();
        return redirect()->route('absensi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = absensi::findOrFail($id);
        $absensi->delete();
        return redirect()->route('absensi.index');
    }
}
