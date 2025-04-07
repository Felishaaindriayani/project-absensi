<?php
namespace App\Http\Controllers;

use Alert;
use App\Models\absensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
        $tanggal = $request->input('tanggal') ?: Carbon::today()->format('Y-m-d');
        $user    = Auth::user();

        $jumlahPegawai = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->count();

        $jumlahHadir = Absensi::whereDate('tanggal', $tanggal)
            ->whereIn('status', ['Hadir', 'Terlambat'])
            ->distinct('id_user')
            ->count('id_user');

        // Pastikan ambil data sesuai peran user
        if ($user->role == 'admin') {
            // Admin melihat semua absensi hari ini
            $absensis = Absensi::whereDate('tanggal', Carbon::today())->with('pegawai')->get();
        } else {
            // User hanya melihat absensinya sendiri
            $absensis = Absensi::where('id_user', $user->id)
                ->whereDate('tanggal', Carbon::today())
                ->with('pegawai')
                ->get();
        }

        return view('home', compact('jumlahPegawai', 'jumlahHadir', 'absensis', 'tanggal', 'user'));
    }

    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $absensis = Absensi::with('pegawai')->get();
        } else {
            $absensis = Absensi::where('id_user', auth()->user()->id)->with('pegawai')->get();
        }

        $check_absen = Absensi::whereDate('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
            ->where('id_user', auth()->user()->id)
            ->first();

        $hasAbsensi = $absensis->isNotEmpty();

        return view('admin.absensi.index', compact('absensis', 'check_absen', 'hasAbsensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $check_absen = Absensi::whereDate('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
            ->where('id_user', auth()->user()->id)
            ->first();

        return view('absensi.create', compact('check_absen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $currentTime    = Carbon::now('Asia/Jakarta');
        $jamMasukBatas  = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta');
        $jamPulangBatas = Carbon::createFromTime(9, 0, 0, 'Asia/Jakarta');

        $absensi = Absensi::where('id_user', auth()->user()->id)
            ->whereDate('tanggal', $currentTime->format('Y-m-d'))
            ->first();

        if ($request->status == 'sakit' && $absensi) {
            Alert::success('Kamu sudah absen hari ini, tidak bisa memilih absen sakit.', 'error');
            return redirect()->back();
        }

        if ($request->status == 'sakit') {
            if ($request->hasFile('photo')) {
                $file     = $request->file('photo');
                $filename = 'photo_' . auth()->user()->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/photo'), $filename);
            }

            $absensi          = new Absensi;
            $absensi->id_user = auth()->user()->id;
            $absensi->tanggal = $currentTime->format('Y-m-d');
            $absensi->status  = 'Sakit';
            $absensi->photo   = $filename ?? null;
            $absensi->save();

            Alert::success('Absen sakit berhasil.', 'success');
            return redirect()->route('absensi.index');
        }

        if ($request->status == 'checkin') {
            if ($absensi) {
                Alert::success('Kamu sudah absen hari ini.', 'error');
                return redirect()->back();
            }

            $isLate = $currentTime->gt(Carbon::createFromTime(07, 0, 0, 'Asia/Jakarta'));

            $absensi            = new Absensi;
            $absensi->id_user   = auth()->user()->id;
            $absensi->tanggal   = $currentTime->format('Y-m-d');
            $absensi->jam_masuk = $currentTime->format('H:i:s');
            $absensi->status    = $isLate ? 'Terlambat' : 'Hadir';
            $absensi->save();

            Alert::success('Check-in berhasil.', 'success');
            return redirect()->back();
        } else {
            if ($currentTime->lessThan($jamPulangBatas)) {
                Alert::success('Anda belum bisa absen pulang sebelum jam 17:00.', 'error');
                return redirect()->back();
            }
        }

        if ($absensi) {
            $jamMasuk    = Carbon::parse($absensi->jam_masuk, 'Asia/Jakarta');
            $jamKeluar   = $currentTime;
            $durasiKerja = $jamMasuk->diff($jamKeluar);

            $absensi->jam_keluar = $jamKeluar->format('H:i:s');
            $absensi->jam_kerja  = $durasiKerja->h . ' jam ' . $durasiKerja->i . ' menit';
            $absensi->save();

            Alert::success('Check-out berhasil.', 'success');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return redirect()->route('absensi.index');
    }
}
