<?php
namespace App\Http\Controllers;

use Alert;
use App\Models\pengajuan_cuti;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('admin.pengajuanCuti.index', compact('pengajuanCuti', 'jumlahCuti'));
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
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $mulai       = Carbon::parse($request->tanggal_mulai);
        $selesai     = Carbon::parse($request->tanggal_selesai);
        $selisihHari = $mulai->diffInDays($selesai);

        if ($selisihHari > 7) {
            Alert::error('Anda tidak dapat mengajukan cuti lebih dari 7 hari', 'error');
            return redirect()->back()->with('error', 'Maksimal cuti hanya bisa 7 hari.');
        }

        $pengajuanCuti                    = new Pengajuan_cuti();
        $pengajuanCuti->id_user           = auth()->user()->id;
        $pengajuanCuti->tanggal_pengajuan = $request->tanggal_pengajuan;
        $pengajuanCuti->kategori_cuti     = $request->kategori_cuti;
        $pengajuanCuti->tanggal_mulai     = $request->tanggal_mulai;
        $pengajuanCuti->tanggal_selesai   = $request->tanggal_selesai;
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
