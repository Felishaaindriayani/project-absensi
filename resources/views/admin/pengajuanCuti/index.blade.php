@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                @if (Auth::user()->hasRole('admin'))
                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0">Pengajuan Cuti</h4>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Start Recent Order -->
                        <div class="col-md-12">
                            <div class="card overflow-hidden mb-0">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title text-black mb-0">Data Pengajuan Cuti</h5>
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
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @php $i=1; @endphp
                                                @foreach ($pengajuanCuti as $data)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $data->pegawai->name }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ $data->kategori_cuti }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($data->tanggal_mulai)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($data->tanggal_selesai)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ $data->alasan }}</td>

                                                        <td>
                                                            @if ($data->status === 'menyetujui')
                                                                <span class="badge bg-info text-dark"
                                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">
                                                                    Menyetujui </span>
                                                            @elseif ($data->status === 'tidak_menyetujui')
                                                                <span class="badge bg-danger text-white"
                                                                    style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">
                                                                    Tidak Menyetujui </span>
                                                            @else
                                                                <form
                                                                    action="{{ route('pengajuanCuti.approve', $data->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm">Approve</button>
                                                                </form>
 
                                                                <form
                                                                    action="{{ route('pengajuanCuti.reject', $data->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('pengajuanCuti.destroy', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="sumbit" onclick="confirm('hapus')"
                                                                    aria-label="anchor" class="btn btn-sm bg-danger-subtle"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Delete">
                                                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if ($pengajuanCuti->isEmpty())
                                            <div class="mt-4 text-center text-gray-500">
                                                <p>No absences found.</p>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="container-fluid">
                                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-18 fw-semibold m-0">Pengajuan Cuti</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Start Recent Order -->
                                            <div class="col-md-12">
                                                <div class="card overflow-hidden mb-0">
                                                    <div class="card-header">
                                                        <div class="d-flex align-items-center">
                                                            <h5 class="card-title text-black mb-0">Buat Pengajuan Cuti</h5>
                                                        </div>
                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center">

                                                            @if ($jumlahCuti >= 5)
                                                                <form action="{{ route('alert') }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Tambah Pengajuan
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal" data-bs-target="#createModal">
                                                                    Tambah Pengajuan
                                                                </button>
                                                            @endif

                                                            </form>
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
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="table-border-bottom-0">
                                                                        @php $i=1; @endphp
                                                                        @foreach ($pengajuanCuti as $data)
                                                                            <tr>
                                                                                <td>{{ $i++ }}</td>
                                                                                <td>{{ $data->pegawai->name }}</td>
                                                                                <td>{{ $data->tanggal_pengajuan }}
                                                                                </td>
                                                                                <td>{{ $data->kategori_cuti }}</td>
                                                                                <td>{{ $data->tanggal_mulai }}
                                                                                </td>
                                                                                <td>{{ $data->tanggal_selesai }}
                                                                                </td>


                                                                                <td>
                                                                                    @if ($data->status === 'menyetujui')
                                                                                        <span
                                                                                            class="badge bg-info text-dark"
                                                                                            style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;"">
                                                                                            Menyetujui </span>
                                                                                        @elseif ($data->status === 'tidak_menyetujui')
                                                                                        <span
                                                                                            class="badge bg-danger text-white"
                                                                                            style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;"">
                                                                                            Tidak Menyetujui </span>
                                                                                    @else
                                                                                        <span
                                                                                            class="badge bg-warning text-white"
                                                                                            style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;"">
                                                                                            Menunggu Konfirmasi </span>
                                                                                    @endif
                                                                                </td>

                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            @if ($pengajuanCuti->isEmpty())
                                                                <div class="mt-4 text-center text-gray-500">
                                                                    <p>No absences found.</p>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        {{-- modal --}}
                                                        <div class="modal fade bs-example-modal-center" id="createModal"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Buat Pengajuan Cuti</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('pengajuanCuti.store') }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Nama</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        value="{{ $pegawai->name ?? 'User tidak ditemukan' }}"
                                                                                        readonly>
                                                                                    <input type="hidden" name="id_user"
                                                                                        value="{{ $pegawai->id ?? '' }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label class="form-label">Tanggal
                                                                                    Pengajuan</label>
                                                                                <input type="date"
                                                                                    class="form-control @error('tanggal_pengajuan') is-invalid @enderror"
                                                                                    name="tanggal_pengajuan" required>
                                                                                @error('tanggal_pengajuan')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label for="kategori_cuti"
                                                                                        class="form-label">Kategori
                                                                                        Cuti</label>
                                                                                    <select class="form-select"
                                                                                        name="kategori_cuti"id="kategori_cuti"
                                                                                        required>
                                                                                        <option selected disabled
                                                                                            value="">Pilih jenis
                                                                                            cuti...</option>
                                                                                        <option>Cuti tahunan</option>
                                                                                        <option>Cuti melahirkan</option>
                                                                                    </select>
                                                                                    @error('kategori_cuti')
                                                                                        <span class="invalid-feedback"
                                                                                            role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6 mb-3">
                                                                                    <label class="form-label">Tanggal
                                                                                        Mulai</label>
                                                                                    <input type="date"
                                                                                        class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                                                        name="tanggal_mulai" required>
                                                                                    @error('tanggal_mulai')
                                                                                        <span class="invalid-feedback"
                                                                                            role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="col-md-6 mb-3">
                                                                                    <label class="form-label">Tanggal
                                                                                        Selesai</label>
                                                                                    <input type="date"
                                                                                        class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                                                        name="tanggal_selesai" required>
                                                                                    @error('tanggal_selesai')
                                                                                        <span class="invalid-feedback"
                                                                                            role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        class="form-label">Alasan</label>
                                                                                    <input type="text"
                                                                                        class="form-control @error('alasan') is-invalid @enderror"
                                                                                        name="alasan" required>
                                                                                    @error('alasan')
                                                                                        <span class="invalid-feedback"
                                                                                            role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror

                                                                                </div>
                                                                                <div class="d-flex justify-content-end">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary me-2"data-bs-dismiss="modal">Tutup</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Simpan</button>
                                                                                </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                @endif
            </div>
        </div>
    @endsection
