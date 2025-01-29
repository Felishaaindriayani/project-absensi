@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Ecommerce</h4>
                    </div>
                </div>
                <div class="row">
                    <!-- Start Recent Order -->
                    <div class="col-md-12">
                        <div class="card overflow-hidden mb-0">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title text-black mb-0">Recent Order</h5>
                                </div>
                                <div class="float-end">
                                    <a href="{{ route('absensi.create') }}" class="btn btn-sm btn-primary">
                                        Tambah Absensi
                                    </a>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-traffic mb-0">

                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Tanggal</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                <th>Status</th>
                                                <th>Jam Kerja</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @php $i=1; @endphp
                                            @foreach ($absensi as $data)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $data->pegawai->name }}</td>
                                                    <td>{{ $data->tanggal }}</td>
                                                    <td>{{ $data->jam_masuk}}</td>
                                                    <td>{{ $data->jam_keluar}}</td>
                                                    <td>
                                                        @if ($data->status == 'Hadir')
                                                            <span
                                                                class="badge bg-primary-subtle text-primary fw-semibold">Hadir</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger-subtle text-danger fw-semibold">Sakit</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $data->jam_kerja}}</td>

                                                    <td>
                                                        <form action="{{ route('absensi.destroy', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="sumbit" onclick="confirm('hapus')"
                                                                aria-label="anchor" class="btn btn-sm bg-danger-subtle"
                                                                data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Recent Order -->
                </div>
            </div>
        </div>
@endsection
