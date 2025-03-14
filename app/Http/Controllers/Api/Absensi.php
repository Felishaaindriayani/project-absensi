<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi as modelAbsen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Absensi extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $absensis = modelAbsen::with('pegawai')->get();
        } else {
            $absensis = modelAbsen::where('id_user', auth()->user()->id)->with('pegawai')->get();
        }

        return response()->json(['success' => true, 'data' => $absensis]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
            'photo'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 400);
        }

        $currentTime = Carbon::now('Asia/Jakarta');
        $absensi     = modelAbsen::where('id_user', auth()->user()->id)
            ->whereDate('tanggal', $currentTime->format('Y-m-d'))
            ->first();

        if ($request->status === 'sakit') {
            if ($absensi) {
                return response()->json(['success' => false, 'message' => 'Sudah absen hari ini.']);
            }

            $filename = null;
            if ($request->hasFile('photo')) {
                $file     = $request->file('photo');
                $filename = 'photo_' . auth()->user()->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/photo'), $filename);
            }

            modelAbsen::create([
                'id_user' => auth()->user()->id,
                'tanggal' => $currentTime->format('Y-m-d'),
                'status'  => 'Sakit',
                'photo'   => $filename,
            ]);

            return response()->json(['success' => true, 'message' => 'Absen sakit berhasil.']);
        }

        if ($request->status === 'checkin') {
            if ($absensi) {
                return response()->json(['success' => false, 'message' => 'Sudah absen hari ini.']);
            }

            modelAbsen::create([
                'id_user'   => auth()->user()->id,
                'tanggal'   => $currentTime->format('Y-m-d'),
                'jam_masuk' => $currentTime->format('H:i:s'),
                'status'    => $currentTime->gt(Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta')) ? 'Terlambat' : 'Hadir',
            ]);

            return response()->json(['success' => true, 'message' => 'Check-in berhasil.']);
        }

        if ($request->status === 'checkout') {
            if (! $absensi) {
                return response()->json(['success' => false, 'message' => 'Anda belum check-in hari ini.']);
            }

            if ($currentTime->lessThan(Carbon::createFromTime(17, 0, 0, 'Asia/Jakarta'))) {
                return response()->json(['success' => false, 'message' => 'Belum bisa check-out sebelum jam 17:00.']);
            }

            $jamMasuk    = Carbon::parse($absensi->jam_masuk, 'Asia/Jakarta');
            $jamKeluar   = $currentTime;
            $durasiKerja = $jamMasuk->diff($jamKeluar);

            $absensi->update([
                'jam_keluar' => $jamKeluar->format('H:i:s'),
                'jam_kerja'  => $durasiKerja->h . ' jam ' . $durasiKerja->i . ' menit',
            ]);

            return response()->json(['success' => true, 'message' => 'Check-out berhasil.']);
        }

        return response()->json(['success' => false, 'message' => 'Status tidak valid.']);
    }

    public function show($id)
    {
        $absensi = modelAbsen::find($id);
        if (! $absensi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
        return response()->json(['success' => true, 'data' => $absensi]);
    }

    public function update(Request $request, $id)
    {
        $absensi = modelAbsen::find($id);
        if (! $absensi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }

        $absensi->update($request->all());
        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.', 'data' => $absensi]);
    }

    public function destroy($id)
    {
        $absensi = modelAbsen::find($id);
        if (! $absensi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }

        $absensi->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
