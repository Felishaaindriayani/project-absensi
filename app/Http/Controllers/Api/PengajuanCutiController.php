<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\pengajuan_cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PengajuanCutiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $pengajuan = pengajuan_cuti::with('pegawai')->get();
        } else {
            $pengajuan = pengajuan_cuti::with('pegawai')->where('id_user', $user->id)->get();
        }

        return response()->json([
            'status'  => true,
            'message' => 'Data pengajuan cuti berhasil diambil',
            'data'    => $pengajuan,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'alasan'            => 'required|string|max:255',
            'kategori_cuti'     => 'required|string',
            'tanggal_pengajuan' => 'required|date',
            'hpl'               => 'required_if:kategori_cuti,Cuti melahirkan|date',
            'tanggal_mulai'     => 'required_if:kategori_cuti,Izin,Cuti tahunan|date',
            'tanggal_selesai'   => 'required_if:kategori_cuti,Izin,Cuti tahunan|date|after_or_equal:tanggal_mulai',
        ]);

        $user = Auth::user();

        if ($request->kategori_cuti == 'Izin') {
            $mulai   = Carbon::parse($request->tanggal_mulai);
            $selesai = Carbon::parse($request->tanggal_selesai);
            if ($mulai->diffInDays($selesai) + 1 > 7) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Tidak bisa mengajukan cuti lebih dari 7 hari',
                ], 422);
            }
        }

        if ($request->kategori_cuti == 'Cuti tahunan') {
            $tahunIni   = Carbon::now()->year;
            $jumlahCuti = pengajuan_cuti::where('id_user', $user->id)
                ->where('kategori_cuti', 'Cuti tahunan')
                ->whereYear('tanggal_mulai', $tahunIni)
                ->count();

            if ($jumlahCuti >= 12) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Cuti tahunan sudah melebihi batas maksimal 12 hari dalam setahun.',
                ], 422);
            }
        }

        if ($request->kategori_cuti == 'Cuti melahirkan') {
            $hpl             = Carbon::parse($request->hpl);
            $tanggal_mulai   = $hpl->copy()->subWeeks(4);
            $tanggal_selesai = $hpl->copy()->addWeeks(8);
        } else {
            $tanggal_mulai   = $request->tanggal_mulai;
            $tanggal_selesai = $request->tanggal_selesai;
        }

        $cuti                    = new pengajuan_cuti();
        $cuti->id_user           = $user->id;
        $cuti->tanggal_pengajuan = $request->tanggal_pengajuan;
        $cuti->kategori_cuti     = $request->kategori_cuti;
        $cuti->tanggal_mulai     = $tanggal_mulai;
        $cuti->tanggal_selesai   = $tanggal_selesai;
        $cuti->alasan            = $request->alasan;
        $cuti->status            = 'menunggu';
        $cuti->save();

        return response()->json([
            'status'  => true,
            'message' => 'Pengajuan cuti berhasil dikirim',
            'data'    => $cuti,
        ]);
    }

    public function show($id)
    {
        $cuti = pengajuan_cuti::with('pegawai')->find($id);
        if (! $cuti) {
            return response()->json([
                'status'  => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Detail pengajuan cuti',
            'data'    => $cuti,
        ]);
    }
}
