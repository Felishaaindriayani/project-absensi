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
                                    <a href="{{ route('pengajuanCuti.create') }}" class="btn btn-sm btn-primary">
                                        Tambah Pengajuan
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
                                                <th>Tanggal Pengajuan</th>
                                                <th>kategori Cuti</th>
                                                <th>Tanggal mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Alasan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @php $i=1; @endphp
                                            @foreach ($pengajuanCuti as $data)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $data->pegawai->name }}</td>
                                                    <td>{{ $data->tanggal_pengajuan }}</td>
                                                    <td>{{ $data->kategori_cuti }}</td>
                                                    <td>{{ $data->tanggal_mulai }}</td>
                                                    <td>{{ $data->tanggal_selesai }}</td>
                                                    <td>{{ $data->alasan }}</td>

                                                    <td>
                                                        @if ($data->status === 'menyetujui')
                                                            <span class="badge bg-info text-dark"
                                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;"">
                                                                Menyetujui </span>
                                                        @elseif ($data->status === 'tidak_menyetujui')
                                                            <span class="badge bg-danger text-white"
                                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;"">
                                                                Tidak Menyetujui </span>
                                                        @else
                                                            <span class="badge bg-warning text-white"
                                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;"">
                                                                Menunggu Konfirmasi </span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <form action="{{ route('pengajuanCuti.destroy', $data->id) }}"
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
