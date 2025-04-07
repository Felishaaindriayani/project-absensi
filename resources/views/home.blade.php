@extends('layouts.admin')
@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .content-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container mt-4 content-container">
                @if (Auth::user()->hasRole('admin'))
                    <h3>Selamat Datang di Dashboard!</h3>
                    <form action="{{ route('home') }}" method="GET" class="d-flex align-items-center gap-2">
                        <label for="tanggal">Pilih Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control w-auto"
                            value="{{ old('tanggal', $tanggal ?? '') }}">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="border p-3 text-center bg-light shadow">
                                <h5>Jumlah Karyawan</h5>
                                <h3>{{ $jumlahPegawai }}</h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border p-3 text-center bg-light shadow">
                                <h5>Jumlah Hadir pada {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}</h5>
                                <h3>{{ $jumlahHadir }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Data Absen Hari Ini</h5>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Status</th>
                                    <th>Jam Kerja</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @forelse ($absensis as $absensi)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $absen->pegawai->name ?? 'Tidak ada data' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                                        <td> {{ \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i:s') ?? '-' }}</td>
                                        <td>
                                            @if ($absensi->jam_keluar)
                                                {{ \Carbon\Carbon::parse($absensi->jam_keluar)->format('H:i:s') ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($absensi->status == 'Hadir')
                                                <span class="badge bg-primary-subtle text-primary fw-semibold"
                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Hadir</span>
                                            @elseif ($absensi->status == 'Terlambat')
                                                <span class="badge bg-danger-subtle text-warning fw-semibold"
                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Terlambat</span>
                                            @elseif ($absensi->status == 'Sakit')
                                                <span class="badge bg-danger-subtle text-danger fw-semibold"
                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Sakit</span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary fw-semibold"
                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Tidak
                                                    Diketahui</span>
                                            @endif
                                        </td>
                                        <td>{{ $absensi->jam_kerja ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data absensi hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
            </div>
        @else
            <div class="container">
                <h3>Selamat Datang, {{ Auth::user()->name }}</h3>

                <div class="card mb-3">
                    <div class="card-body">
                        <ul class="list-unstyled mb-3">
                            <li class="text-sm mb-2 d-flex align-items-center">
                                <i class="mdi mdi-alert-circle-outline me-2 text-primary"></i>
                                <span class="font-weight-bold">Status:</span>
                                <span
                                    class="ms-1">{{ Auth::user()->status_pegawai == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </li>
                            <li class="text-sm mb-2 d-flex align-items-center">
                                <i class="mdi mdi-briefcase me-2 text-primary"></i>
                                <span class="font-weight-bold">Jabatan:</span>
                                <span class="ms-1">{{ Auth::user()->jabatan->jabatan ?? 'Tidak ada jabatan' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                @if (!$sudahAbsen)
                    <div class="alert alert-warning" role="alert">
                        ⚠️ Pengingat: Anda belum melakukan absensi hari ini!
                    </div>
                @else
                    <div class="alert alert-success" role="alert">
                        ✅ Terima kasih! Anda telah melakukan absensi hari ini.
                    </div>
                @endif

                <div class="mt-4">
                    <h5>Riwayat Absen Hari Ini</h5>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status</th>
                                <th>Jam Kerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @forelse ($absensis as $absensi)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $absensi->pegawai->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                                    <td> {{ \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i:s') ?? '-' }}</td>
                                    <td>
                                        @if ($absensi->jam_keluar)
                                            {{ \Carbon\Carbon::parse($absensi->jam_keluar)->format('H:i:s') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($absensi->status == 'Hadir')
                                            <span class="badge bg-primary-subtle text-primary fw-semibold"
                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Hadir</span>
                                        @elseif ($absensi->status == 'Terlambat')
                                            <span class="badge bg-danger-subtle text-warning fw-semibold"
                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Terlambat</span>
                                        @elseif ($absensi->status == 'Sakit')
                                            <span class="badge bg-danger-subtle text-danger fw-semibold"
                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Sakit</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary fw-semibold"
                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Tidak
                                                Diketahui</span>
                                        @endif
                                    </td>
                                    <td>{{ $absensi->jam_kerja ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada riwayat absensi hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif


            {{-- <div class="container-fluid">
                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                            </div>
                        </div>

                        <!-- Start Row -->
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget-first">
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="bg-secondary-subtle rounded-2 p-1 me-2 border border-dashed border-secondary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 512"><path fill="#963b68" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m32 32h-64c-17.6 0-33.5 7.1-45.1 18.6c40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64m-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32S208 82.1 208 144s50.1 112 112 112m76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2m-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4"/></svg>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Data pegawai</p>
                                                    </div>
                                                    <h3 class="mb-0 fs-24 text-black me-2">#</h3>
                                                </div>

                                                <div>
                                                    <div id="new-orders" class="apex-charts"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget-first">
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="bg-secondary-subtle rounded-2 p-1 me-2 border border-dashed border-secondary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 512"><path fill="#963b68" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m32 32h-64c-17.6 0-33.5 7.1-45.1 18.6c40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64m-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32S208 82.1 208 144s50.1 112 112 112m76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2m-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4"/></svg>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Jabatan</p>
                                                    </div>
                                                    <h3 class="mb-0 fs-24 text-black me-2">#</h3>
                                                </div>

                                                <div>
                                                    <div id="monthly-orders" class="apex-charts"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget-first">
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="bg-info-subtle rounded-2 p-1 me-2 border border-dashed border-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#73bbe2" d="M7 20V8.975q0-.825.6-1.4T9.025 7H20q.825 0 1.413.587T22 9v8l-5 5H9q-.825 0-1.412-.587T7 20M2.025 6.25q-.15-.825.325-1.487t1.3-.813L14.5 2.025q.825-.15 1.488.325t.812 1.3L17.05 5H9Q7.35 5 6.175 6.175T5 9v9.55q-.4-.225-.687-.6t-.363-.85zM20 16h-4v4z"/></svg>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Absensi</p>   
                                                    </div>
                                                    <h3 class="mb-0 fs-24 text-black me-2">#</h3>
                                                </div>

                                                <div>
                                                    <div id="monthly-revenue" class="apex-charts"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="widget-first">
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="bg-warning-subtle rounded-2 p-1 me-2 border border-dashed border-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#f59440" d="M5.574 4.691c-.833.692-1.052 1.862-1.491 4.203l-.75 4c-.617 3.292-.926 4.938-.026 6.022C4.207 20 5.88 20 9.23 20h5.54c3.35 0 5.025 0 5.924-1.084c.9-1.084.591-2.73-.026-6.022l-.75-4c-.439-2.34-.658-3.511-1.491-4.203C17.593 4 16.403 4 14.02 4H9.98c-2.382 0-3.572 0-4.406.691" opacity="0.5"/><path fill="#988D4D" d="M12 9.25a2.251 2.251 0 0 1-2.122-1.5a.75.75 0 1 0-1.414.5a3.751 3.751 0 0 0 7.073 0a.75.75 0 1 0-1.414-.5A2.251 2.251 0 0 1 12 9.25"/></svg>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Pengajuan Cuti</p>
                                                    </div>
                                                    <h3 class="mb-0 fs-24 text-black me-2">#</h3>
                                                </div>

                                                <div>
                                                    <div id="items-stock" class="apex-charts"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div> <!-- content --> --}}

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col fs-13 text-muted text-center">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a
                                href="#!" class="text-reset fw-semibold">Zoyothemes</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
    @endsection
