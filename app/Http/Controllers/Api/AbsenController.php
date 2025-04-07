<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $absensis = Absensi::with('pegawai')->get();
        } else {
            $absensis = Absensi::where('id_user', auth()->user()->id)->with('pegawai')->get();
        }
        return response()->json($absensis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
            'photo'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $currentTime    = Carbon::now('Asia/Jakarta');
        $jamPulangBatas = Carbon::createFromTime(17, 0, 0, 'Asia/Jakarta');

        $absensi = Absensi::where('id_user', auth()->user()->id)
            ->whereDate('tanggal', $currentTime->format('Y-m-d'))
            ->first();

        if ($request->status == 'sakit' && $absensi) {
            return response()->json(['message' => 'Sudah absen hari ini, tidak bisa memilih absen sakit'], 400);
        }

        if ($request->status == 'sakit') {
            $filename = null;
            if ($request->hasFile('photo')) {
                $file     = $request->file('photo');
                $filename = 'photo_' . auth()->user()->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/photo'), $filename);
            }

            Absensi::create([
                'id_user' => auth()->user()->id,
                'tanggal' => $currentTime->format('Y-m-d'),
                'status'  => 'Sakit',
                'photo'   => $filename,
            ]);

            return response()->json(['message' => 'Absen sakit berhasil'], 201);
        }

        if ($request->status == 'checkin') {
            if ($absensi) {
                return response()->json(['message' => 'Sudah absen hari ini'], 400);
            }

            $isLate = $currentTime->gt(Carbon::createFromTime(07, 0, 0, 'Asia/Jakarta'));
            Absensi::create([
                'id_user'   => auth()->user()->id,
                'tanggal'   => $currentTime->format('Y-m-d'),
                'jam_masuk' => $currentTime->format('H:i:s'),
                'status'    => $isLate ? 'Terlambat' : 'Hadir',
            ]);

            return response()->json(['message' => 'Check-in berhasil'], 201);
        }

        if ($request->status == 'checkout') {
            if (! $absensi) {
                return response()->json(['message' => 'Belum melakukan check-in'], 400);
            }
            if ($currentTime->lessThan($jamPulangBatas)) {
                return response()->json(['message' => 'Belum bisa absen pulang sebelum jam 17:00'], 400);
            }

            $jamMasuk    = Carbon::parse($absensi->jam_masuk, 'Asia/Jakarta');
            $jamKeluar   = $currentTime;
            $durasiKerja = $jamMasuk->diff($jamKeluar);

            $absensi->update([
                'jam_keluar' => $jamKeluar->format('H:i:s'),
                'jam_kerja'  => $durasiKerja->h . ' jam ' . $durasiKerja->i . ' menit',
            ]);

            return response()->json(['message' => 'Check-out berhasil'], 200);
        }

        return response()->json(['message' => 'Status tidak valid'], 400);
    }

    public function destroy($id)
    {
        if (! auth()->user()->hasRole('admin')) {
            return response()->json(['message' => 'Tidak memiliki akses'], 403);
        }
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return response()->json(['message' => 'Absensi berhasil dihapus'], 200);
    }
}
