<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_cuti;
use App\Models\User;

use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuanCuti = Pengajuan_cuti::all();
        return view('admin.pengajuanCuti.index', compact('pengajuanCuti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengajuanCuti = pengajuan_cuti::all();
        $pegawai = User::all();
        return view('admin.pengajuanCuti.create', compact('pengajuanCuti', 'pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pengajuanCuti             = new  Pengajuan_cuti();
        $pengajuanCuti->id_user    = $request->id_user;
        $pengajuanCuti->tanggal_pengajuan    = $request->tanggal_pengajuan;
        $pengajuanCuti->kategori_cuti  = $request->kategori_cuti;
        $pengajuanCuti->tanggal_mulai = $request->tanggal_mulai;
        $pengajuanCuti->tanggal_selesai = $request->tanggal_selesai;
        $pengajuanCuti->alasan = $request->alasan;
        $pengajuanCuti->status     = 'menunggu';
        

        $pengajuanCuti->save();
        return redirect()->route('pengajuanCuti.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(pengajuan_cuti $pengajuan_cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengajuan_cuti $pengajuan_cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengajuan_cuti $pengajuan_cuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengajuan_cuti $pengajuan_cuti)
    {
        //
    }
}
