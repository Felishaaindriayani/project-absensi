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
        $jumlahCuti  = pengajuan_cuti::where('id_user', auth()->id())
            ->whereYear('tanggal_mulai', $currentYear)
            ->count();

        $pegawai = Auth::user();

        // // 🛎️ Tambahkan ini buat notifikasi
        // $jumlahNotif = pengajuan_cuti::where('status', 'pending')->count();
        // $daftarNotif = pengajuan_cuti::where('status', 'pending')->latest()->take(5)->get();

        return view('admin.pengajuanCuti.index', compact('pengajuanCuti', 'jumlahCuti', 'pegawai'));
    }

    // public function notif()
    // {
    //     $pengajuanCuti = pengajuan_cuti::latest()->get();

    //     // Notifikasi buat admin
    //     $jumlahNotif = pengajuan_cuti::where('status', 'pending')->count();
    //     $daftarNotif = pengajuan_cuti::where('status', 'pending')->latest()->take(5)->get();

    //     return view('admin.PengajuanCuti.index', compact('pengajuanCuti', 'jumlahNotif', 'daftarNotif'));
    // }

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
        // Validasi awal
//     $request->validate([
//     'alasan'            => 'required|string|max:255',
//     'kategori_cuti'     => 'required|string',
//     'tanggal_pengajuan' => 'required|date',
//     'hpl'               => 'required_if:kategori_cuti,Cuti melahirkan|date',
//     'tanggal_mulai'     => 'sometimes|required_if:kategori_cuti,Izin,Cuti tahunan|date',
//     'tanggal_selesai'   => 'sometimes|required_if:kategori_cuti,Izin,Cuti tahunan|date|after_or_equal:tanggal_mulai',
// ]);

        // Validasi tambahan: Jika user laki-laki memilih cuti melahirkan
        if ($request->kategori_cuti === 'Cuti melahirkan' && auth()->user()->jenis_kelamin === 'L') {
            Alert::error('User laki-laki tidak dapat mengajukan cuti melahirkan.', 'error');
            return back();
        }

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
            $tahunIni   = Carbon::now()->year;
            $jumlahCuti = Pengajuan_cuti::where('id_user', auth()->id())
                ->where('kategori_cuti', 'Cuti tahunan')
                ->whereYear('tanggal_mulai', $tahunIni)
                ->count();

            if ($jumlahCuti >= 12) {
                Alert::error('Cuti tahunan sudah melebihi batas maksimal 12 hari dalam setahun.', 'error');
                return back();
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

    // public function alert()
    // {
    //     Alert::error('Pengajuan cuti ditolak! Anda sudah mencapai batas 5 kali dalam setahun.', 'error');
    //     return redirect()->route('pengajuanCuti.index');

    // }

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

    public function getNotification()
    {
        // if (Auth::check()) {
        //     if (Auth::user()->hasRole('admin')) {
        //         // Admin: ambil pengajuan cuti yang menunggu
        //         $cutiNotif = pengajuan_cuti::where('status', 'menunggu')->get();
        //     } else {
        //         // User: ambil pengajuan cuti miliknya yang sudah diproses
        //         $cutiNotif = pengajuan_cuti::where('id_user', Auth::id())
        //             ->whereIn('status', ['menyetujui', 'tidak_menyetujui'])
        //             ->get();
        //     }

        //     return response()->json([
        //         'data' => $cutiNotif,
        //     ]);
        // }

        // return response()->json([
        //     'message' => 'Unauthorized',
        // ], 401);

        $meetNotification = Meeting::where('status', 'menunggu')->count();

        return response()->json([
            'meetCount' => $meetNotification,
        ]);

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
