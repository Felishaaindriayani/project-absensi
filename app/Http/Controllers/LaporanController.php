<?php
namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Menampilkan halaman laporan absensi
    public function absensi(Request $request)
    {
        // Ambil semua user yang memiliki role 'user' (pegawai)
        $user = User::role('user')->get();

        // Ambil data absensi sesuai filter
        $absensis = Absensi::with('pegawai')
            ->when($request->tanggal_mulai, function ($query) use ($request) {
                $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
            })
            ->when($request->tanggal_selesai, function ($query) use ($request) {
                $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
            })
            ->when($request->id_user, function ($query) use ($request) {
                $query->where('id_user', $request->id_user);
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        $tanggal_mulai   = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;

        return view('admin.laporan.absensi', compact('absensis', 'user', 'tanggal_mulai', 'tanggal_selesai'));
    }

    public function cariPegawai(Request $request)
    {
        $keyword = $request->get('q');

        $pegawai = User::role('user')
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                    ->orWhere('nip', 'like', "%$keyword%");
            })
            ->select('id', 'name', 'nip')
            ->get();

        $data = $pegawai->map(function ($item) {
            return [
                'id'   => $item->id,
                'text' => $item->name . ' - ' . $item->nip,
            ];
        });

        return response()->json($data);
    }

    // Export PDF berdasarkan filter
    public function exportPdf(Request $request)
    {
        // Ambil data absensi sesuai filter
        $absensis = Absensi::with('pegawai')
            ->when($request->tanggal_mulai, function ($query) use ($request) {
                $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
            })
            ->when($request->tanggal_selesai, function ($query) use ($request) {
                $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
            })
            ->when($request->id_user, function ($query) use ($request) {
                $query->where('id_user', $request->id_user);
            })
            ->orderBy('tanggal', 'desc')
            ->get();

        // Kirim data ke view PDF
        $pdf = Pdf::loadView('admin.laporan.pdf_absensi', compact('absensis'));

        // Bisa stream atau download, silakan pilih
        return $pdf->download('laporan_absensi.pdf');
        // return $pdf->stream('laporan_absensi.pdf'); // Kalau mau ditampilkan di browser
    }
}
