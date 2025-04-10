@extends('layouts.admin')

@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid  mt-4">
                        <div class="card shadow rounded-4 p-4">
                            <h4 class="mb-4">Rekap Absensi</h4>

                            <form action="{{ route('laporan.absensi') }}" method="GET">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="tanggal_mulai" class="form-label">Dari Tanggal</label>
                                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                                            value="{{ request('tanggal_mulai') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tanggal_selesai" class="form-label">Sampai Tanggal</label>
                                        <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                            class="form-control" value="{{ request('tanggal_selesai') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="id_user" class="form-label">Pilih Karyawan</label>
                                        <select name="id_user" id="id_user" class="form-select">
                                            <option value="">Semua Karyawan</option>
                                            @foreach ($user as $pegawai)
                                                <option value="{{ $pegawai->id }}"
                                                    {{ request('id_user') == $pegawai->id ? 'selected' : '' }}>
                                                    {{ $pegawai->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-end gap-2">
                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                    </div>
                                    <div class="col-md-3 offset-md-6 d-flex gap-2">
                                        <a href="{{ route('laporan.absensi.excel', request()->query()) }}"
                                            class="btn btn-success w-100">Export Excel</a>
                                        <a href="{{ route('laporan.absensi.pdf', request()->query()) }}" class="btn btn-danger">Export PDF</a>

                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive mt-4">
                                <table class="table table-bordered table-striped">
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
                                        @php $i = 1; @endphp
                                        @forelse ($absensis as $absensi)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $absensi->pegawai->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}</td>
                                                <td>{{ $absensi->jam_masuk ?? '-' }}</td>
                                                <td>{{ $absensi->jam_keluar ?? '-' }}</td>
                                                <td>
                                                    @php
                                                        $badgeClass = match ($absensi->status) {
                                                            'Hadir' => 'bg-primary-subtle text-primary',
                                                            'Terlambat' => 'bg-warning-subtle text-warning',
                                                            'Sakit' => 'bg-danger-subtle text-danger',
                                                            default => 'bg-secondary-subtle text-secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }} fw-semibold"
                                                        style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">
                                                        {{ $absensi->status }}
                                                    </span>
                                                </td>
                                                <td>{{ $absensi->jam_kerja ?? '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Tidak ada data absensi.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                  
@endsection
