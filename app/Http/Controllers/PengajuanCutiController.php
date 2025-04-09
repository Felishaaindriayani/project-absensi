<?php
namespace App\Http\Controllers;

use Alert;
use App\Models\pengajuan_cuti;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $pengajuanCuti = pengajuan_cuti::with('pegawai')->get();
        } else {
            $pengajuanCuti = pengajuan_cuti::where('id_user', auth()->user()->id)->with('pegawai')->get();
        }

        $currentYear = Carbon::now()->year;
        $jumlahCuti = Pengajuan_cuti::where('id_user', auth()->id())
            ->whereYear('tanggal_mulai', $currentYear)
            ->count();

        $pegawai = Auth::user();

        return view('admin.pengajuanCuti.index', compact('pengajuanCuti', 'jumlahCuti','pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengajuanCuti = pengajuan_cuti::all();
        $pegawai       = User::all();
        return view('admin.pengajuanCuti.create', compact('pengajuanCuti', 'pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'alasan'          => 'required|string|max:255',
        'kategori_cuti'   => 'required|string',
        'tanggal_pengajuan' => 'required|date',
        'hpl'             => 'required_if:kategori_cuti,Cuti melahirkan|date',
        'tanggal_mulai'   => 'required_if:kategori_cuti,Izin,Cuti tahunan|date',
        'tanggal_selesai' => 'required_if:kategori_cuti,Izin,Cuti tahunan|date|after_or_equal:tanggal_mulai',
    ]);

    if ($request->kategori_cuti == 'Izin') {
        $mulai       = Carbon::parse($request->tanggal_mulai);
        $selesai     = Carbon::parse($request->tanggal_selesai);
        $selisihHari = $mulai->diffInDays($selesai) + 1;

        if ($selisihHari > 7) {
            Alert::error('Anda tidak dapat mengajukan cuti lebih dari 7 hari', 'error');
            return back();
        }
    }

    if ($request->kategori_cuti == 'Cuti tahunan') {
        $tahunIni = Carbon::now()->year;
        $jumlahCuti = Pengajuan_cuti::where('id_user', auth()->id())
            ->where('kategori_cuti', 'Cuti tahunan')
            ->whereYear('tanggal_mulai', $tahunIni)
            ->count();

        if ($jumlahCuti >= 12) {
            Alert::error('Cuti tahunan sudah melebihi batas maksimal 12 hari dalam setahun.', 'error');
            return back();
        }
    }

    // Hitung otomatis tanggal cuti melahirkan dari HPL
    if ($request->kategori_cuti == 'Cuti melahirkan') {
        $hpl = Carbon::parse($request->hpl);
        $tanggal_mulai = $hpl->copy()->subWeeks(4); // 1 bulan sebelum HPL
        $tanggal_selesai = $hpl->copy()->addWeeks(8); // 2 bulan setelah HPL
    } else {
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;
    }

    $pengajuanCuti                    = new Pengajuan_cuti();
    $pengajuanCuti->id_user           = auth()->user()->id;
    $pengajuanCuti->tanggal_pengajuan = $request->tanggal_pengajuan;
    $pengajuanCuti->kategori_cuti     = $request->kategori_cuti;
    $pengajuanCuti->tanggal_mulai     = $tanggal_mulai;
    $pengajuanCuti->tanggal_selesai   = $tanggal_selesai;
    $pengajuanCuti->alasan            = $request->alasan;
    $pengajuanCuti->status            = 'menunggu';

    $pengajuanCuti->save();

    Alert::success('Pengajuan Cuti berhasil dikirim.', 'success');
    return redirect()->route('pengajuanCuti.index');
}

    public function alert()
    {
        Alert::error('Pengajuan cuti ditolak! Anda sudah mencapai batas 5 kali dalam setahun.', 'error');
        return redirect()->route('pengajuanCuti.index');

    }

    public function approve($id)
    {
        $pengajuanCuti         = pengajuan_cuti::findOrFail($id);
        $pengajuanCuti->status = 'menyetujui';
        $pengajuanCuti->save();

        Alert::success('Succes', 'Pengajuan cuti berhasil disetujui !')->autoClose(1500);
        return redirect()->back();
    }

    public function reject($id)
    {
        $pengajuanCuti         = pengajuan_cuti::findOrFail($id);
        $pengajuanCuti->status = 'tidak_menyetujui';
        $pengajuanCuti->save();

        Alert::error('Error', 'Pengajuan cuti tidak disetujui !')->autoClose(1500);
        return redirect()->back();
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
