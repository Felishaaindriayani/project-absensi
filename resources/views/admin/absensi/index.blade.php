@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                @if (Auth::user()->hasRole('admin'))
                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0"></h4>
                        </div>
                    </div>
                    <!-- Start Recent Order -->
                    {{-- <div class="col-md-12">
                            <div class="card overflow-hidden mb-0">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title text-black mb-0">Data Absensi Pegawai </h5>
                                    </div> --}}

                    {{-- <div class="float-end">
                                    <a href="{{ route('absensi.create') }}" class="btn btn-sm btn-primary">
                                        Tambah Absensi
                                    </a>
                                </div> --}}


                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h5 class="card-title mb-0">Data Absensi Pegawai </h5>
                                </div><!-- end card header -->

                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable"
                                                class="table table-bordered dt-responsive table-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Keluar</th>
                                                        <th>Status</th>
                                                        <th>Surat Dokter</th>
                                                        <th>Jam Kerja</th>
                                                        {{-- <th>Aksi</th> --}}

                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    @php $i=1; @endphp
                                                    @foreach ($absensis as $absensi)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $absensi->pegawai->name }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}
                                                            </td>
                                                            <td> {{ \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i:s') ?? '-' }}
                                                            </td>
                                                            <td>
                                                                @if ($absensi->jam_keluar)
                                                                    {{ \Carbon\Carbon::parse($absensi->jam_keluar)->format('H:i:s') }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($absensi->status == 'Hadir')
                                                                    <span
                                                                        class="badge bg-primary-subtle text-primary fw-semibold"
                                                                        style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Hadir</span>
                                                                @elseif ($absensi->status == 'Terlambat')
                                                                    <span
                                                                        class="badge bg-danger-subtle text-warning fw-semibold"
                                                                        style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Terlambat</span>
                                                                @elseif ($absensi->status == 'Sakit')
                                                                    <span
                                                                        class="badge bg-danger-subtle text-danger fw-semibold"
                                                                        style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Sakit</span>
                                                                @else
                                                                    <span
                                                                        class="badge bg-secondary-subtle text-secondary fw-semibold"
                                                                        style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Tidak
                                                                        Diketahui</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($absensi->photo)
                                                                    <a href="{{ asset('uploads/photo/' . $absensi->photo) }}"
                                                                        target="_blank" class="btn btn-sm btn-info">
                                                                        Lihat Surat
                                                                    </a>
                                                                @else
                                                                    <span class="text-muted">Tidak ada surat</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $absensi->jam_kerja ?? '-' }}</td>


                                                            {{-- <td>
                                                                <form action="{{ route('absensi.destroy', $absensi->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="sumbit" onclick="confirm('hapus')"
                                                                        aria-label="anchor"
                                                                        class="btn btn-sm bg-danger-subtle"
                                                                        data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete">
                                                                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                                    </button>
                                                                </form>
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        @if ($absensis->isEmpty())
                                            <div class="mt-4 text-center text-gray-500">
                                                <p>No absences found.</p>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="container-fluid">
                                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-18 fw-semibold m-0"></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card overflow-hidden mb-0">
                                                    <div class="card-header">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="card-title text-black mb-0">Absens hari ini
                                                                {{ Auth::user()->name }}
                                                            </h5>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <form method="POST" action="{{ route('absensi.store') }}">
                                                                @csrf
                                                                <input type="hidden" name="status"
                                                                    value="{{ $check_absen === 'checkout' ? '' : ($check_absen ? 'checkout' : 'checkin') }}">

                                                                <div
                                                                    class="card-header d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        @if ($check_absen && $check_absen->status == 'Sakit')
                                                                            <button type="button" class="btn btn-danger"
                                                                                disabled>
                                                                                Sudah Absen (Sakit)
                                                                            </button>
                                                                        @elseif ($check_absen && $check_absen->jam_keluar)
                                                                            <button type="submit" class="btn btn-danger"
                                                                                disabled>
                                                                                Sudah Absen
                                                                            </button>
                                                                        @elseif ($check_absen)
                                                                            <button type="submit" class="btn btn-success">
                                                                                Absen Pulang
                                                                            </button>
                                                                        @else
                                                                            <button type="submit" class="btn btn-primary">
                                                                                Absen Masuk
                                                                            </button>
                                                                        @endif
                                                                    </div>

                                                                    <div>
                                                                        <button type="button" class="btn btn-warning"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sakitModal"
                                                                            {{ $check_absen && ($check_absen->status == 'Sakit' || $check_absen->jam_masuk) ? 'disabled' : '' }}>
                                                                            Sakit
                                                                        </button>
                                                                    </div>
                                                                </div>



                                                            </form>

                                                            {{-- <div>
                                                            <button type="button" class="btn btn-warning"
                                                                data-bs-toggle="modal" data-bs-target="#sakitModal">
                                                                Sakit
                                                            </button>
                                                        </div> --}}

                                                            <!-- Modal Upload Surat Dokter -->
                                                            <div class="modal fade" id="sakitModal" tabindex="-1"
                                                                aria-labelledby="sakitModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="sakitModalLabel">
                                                                                Upload Surat Dokter</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="{{ route('absensi.store') }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="status"
                                                                                value="sakit">
                                                                            <div class="modal-body">
                                                                                <label for="photo"
                                                                                    class="form-label">Upload
                                                                                    Surat Dokter
                                                                                    (JPG/PNG/PDF)</label>
                                                                                <input type="file" name="photo"
                                                                                    class="form-control"
                                                                                    accept="image/*,application/pdf"
                                                                                    required>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-warning">Kirim</button>
                                                                            </div>
                                                                        </form>


                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table id="datatable"
                                                                            class="table table-bordered dt-responsive table-responsive nowrap">
                                                                            <thead>
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
                                                                            <tbody class="table-border-bottom-0">
                                                                                @php $i=1; @endphp
                                                                                @foreach ($absensis as $absensi)
                                                                                    <tr>
                                                                                        <td>{{ $i++ }}</td>
                                                                                        <td>{{ $absensi->pegawai->name }}
                                                                                        </td>
                                                                                        <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d-m-Y') }}
                                                                                        </td>
                                                                                        <td>{{ $absensi->jam_masuk ?? '-' }}
                                                                                        </td>
                                                                                        <td>{{ $absensi->jam_keluar ?? '-' }}
                                                                                        </td>
                                                                                        <td>

                                                                                            @if ($absensi->status == 'Hadir')
                                                                                                <span
                                                                                                    class="badge bg-primary-subtle text-primary fw-semibold"
                                                                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Hadir</span>
                                                                                                @elseif($absensi->status == 'Terlambat')
                                                                                                <span
                                                                                                    class="badge bg-danger-subtle text-warning fw-semibold"
                                                                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Terlambat</span>
                                                                                            @elseif($absensi->status == 'Sakit')
                                                                                                <span
                                                                                                    class="badge bg-danger-subtle text-danger fw-semibold"
                                                                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Sakit</span>
                                                                                            @else
                                                                                                <span
                                                                                                    class="badge bg-secondary-subtle text-secondary fw-semibold"
                                                                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Tidak
                                                                                                    Ada Keterangan</span>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>{{ $absensi->jam_kerja ?? '-' }}
                                                                                        </td>


                                                                                        {{-- <td>
                                                                                    <form
                                                                                        action="{{ route('absensi.destroy', $absensi->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="sumbit"
                                                                                            onclick="confirm('hapus')"
                                                                                            aria-label="anchor"
                                                                                            class="btn btn-sm bg-danger-subtle"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="Delete">
                                                                                            <i
                                                                                                class="mdi mdi-delete fs-14 text-danger"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                </td> --}}
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    @if ($absensis->isEmpty())
                                                                        <div class="mt-4 text-center text-gray-500">
                                                                            <p>No absences found.</p>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Recent Order -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Bootstrap 5 Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
