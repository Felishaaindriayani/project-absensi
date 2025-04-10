@extends('layouts.admin')

@section('content')

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid  mt-4">
                <div class="card shadow rounded-4 p-4">
                    <h4 class="mb-4">Rekap Absensi</h4>

                    <form method="GET" action="{{ route('laporan.absensi') }}">
                        <div class="row g-3">
                            <!-- Dari Tanggal -->
                            <div class="col-md-3">
                                <label for="tanggal_mulai" class="form-label">Dari Tanggal</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                                    value="{{ request('tanggal_mulai') }}">
                            </div>

                            <!-- Sampai Tanggal -->
                            <div class="col-md-3">
                                <label for="tanggal_selesai" class="form-label">Sampai Tanggal</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                                    value="{{ request('tanggal_selesai') }}">
                            </div>

                            <!-- Search Pegawai -->
                            <div class="col-md-3">
                                <label for="name" class="form-label">Pilih Pegawai</label>
                                <select id="name" class="form-control"></select>
                                <input type="hidden" name="id_user" id="id_user" value="{{ request('id_user') }}">
                            </div>

                            <!-- Tombol Filter -->
                            <div class="col-md-3 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                            <div class="col-md-3 offset-md-6 d-flex gap-2">
                                <a href="{{ route('laporan.absensi.excel', request()->query()) }}"
                                    class="btn btn-success w-100">Export
                                    Excel</a>
                                <a href="{{ route('laporan.absensi.pdf', request()->query()) }}"
                                    class="btn btn-danger w-100" target="_blank">Export PDF</a>
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

@push('scripts')
    <!-- jQuery (kalau belum ada) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function () {
        $('#name').select2({
            placeholder: 'Cari Nama atau NIP...',
            minimumInputLength: 1,
            allowClear: true,
            width: '100%', // ⬅️ ini biar ukurannya sejajar input lainnya
            ajax: {
                url: '{{ route('cari.pegawai') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
            }
        });

        // ⬇️ Auto-redirect saat pilih pegawai
        $('#name').on('select2:select', function (e) {
            var data = e.params.data;
            var id_user = data.id;

            let tanggal_mulai = $('input[name="tanggal_mulai"]').val();
            let tanggal_selesai = $('input[name="tanggal_selesai"]').val();

            var url = new URL(window.location.href.split('?')[0]);
            var params = new URLSearchParams();

            if (tanggal_mulai) params.append('tanggal_mulai', tanggal_mulai);
            if (tanggal_selesai) params.append('tanggal_selesai', tanggal_selesai);
            if (id_user) params.append('id_user', id_user);

            url.search = params.toString();
            window.location.href = url.toString();
        });
    });
</script>

@endpush
