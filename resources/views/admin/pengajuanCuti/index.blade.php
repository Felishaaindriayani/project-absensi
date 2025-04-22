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
                    <div class="row">
                        <!-- Start Recent Order -->
                        <div class="col-md-12">
                            <div class="card overflow-hidden mb-0">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title text-black mb-0">Data Pengajuan Cuti</h5>
                                    </div>
                                    @role('user')
                                    <div class="float-end">
                                        <a href="{{ route('pengajuanCuti.create') }}" class="btn btn-sm btn-primary">
                                            Tambah Pengajuan
                                        </a>
                                    </div>
                                    @endrole
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
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
                                                                <form
                                                                    action="{{ route('pengajuanCuti.destroy', $data->id) }}"
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
                                                    <h4 class="fs-18 fw-semibold m-0"></h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Start Recent Order -->
                                                <div class="col-md-12">
                                                    <div class="card overflow-hidden mb-0">
                                                        <div class="card-header">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="card-title text-black mb-0">Buat Pengajuan Cuti
                                                                </h5>
                                                            </div>
                                                            <div
                                                                class="card-header d-flex justify-content-between align-items-center">

                                                                {{-- @if ($jumlahCuti >= 5)
                                                                <form action="{{ route('alert') }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Tambah Pengajuan
                                                                    </button>
                                                                </form>
                                                            @else --}}
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal" data-bs-target="#createModal">
                                                                    Tambah Pengajuan
                                                                </button>
                                                                {{-- @endif --}}

                                                                </form>
                                                            </div>

                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
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
                                                                                                    Menunggu Konfirmasi
                                                                                                </span>
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

                                                                <!-- Modal Pengajuan Cuti -->
                                                                <div class="modal fade bs-example-modal-center"
                                                                    id="createModal" tabindex="-1" role="dialog"
                                                                    aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                    <div
                                                                        class="modal-dialog modal-lg modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Buat Pengajuan Cuti
                                                                                </h5>
                                                                                <button type="button"
                                                                                    class="btn-close text-white"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('pengajuanCuti.store') }}"
                                                                                    method="POST"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-3">
                                                                                            <label
                                                                                                class="form-label">Nama</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                value="{{ $pegawai->name ?? 'User tidak ditemukan' }}"
                                                                                                readonly>
                                                                                            <input type="hidden"
                                                                                                name="id_user"
                                                                                                value="{{ $pegawai->id ?? '' }}">
                                                                                        </div>
                                                                                        <!-- HPL (khusus cuti melahirkan) -->
                                                                                        <!-- HPL -->
                                                                                        <div class="col-md-6"
                                                                                            id="hpl_section"
                                                                                            style="display: none;">
                                                                                            <div class="form-group">
                                                                                                <label for="hpl_input">Hari
                                                                                                    Perkiraan Lahir
                                                                                                    (HPL)</label>
                                                                                                <input type="date"
                                                                                                    id="hpl_input"
                                                                                                    name="hpl"
                                                                                                    class="form-control">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label
                                                                                                class="form-label">Tanggal
                                                                                                Pengajuan</label>
                                                                                            <input type="date"
                                                                                                class="form-control @error('tanggal_pengajuan') is-invalid @enderror"
                                                                                                name="tanggal_pengajuan"
                                                                                                required>
                                                                                            @error('tanggal_pengajuan')
                                                                                                <span class="invalid-feedback"
                                                                                                    role="alert"><strong>{{ $message }}</strong></span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label
                                                                                                class="form-label">Kategori
                                                                                                Cuti</label>
                                                                                            <select class="form-select"
                                                                                                name="kategori_cuti"
                                                                                                id="kategori_cuti"
                                                                                                required>
                                                                                                <option selected disabled
                                                                                                    value="">Pilih
                                                                                                    jenis
                                                                                                    cuti...</option>
                                                                                                <option value="Izin">Izin
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Cuti tahunan">
                                                                                                    Cuti
                                                                                                    tahunan</option>
                                                                                                <option
                                                                                                    value="Cuti melahirkan">
                                                                                                    Cuti melahirkan</option>
                                                                                            </select>

                                                                                            @error('kategori_cuti')
                                                                                                <span class="invalid-feedback"
                                                                                                    role="alert"><strong>{{ $message }}</strong></span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label
                                                                                                class="form-label">Tanggal
                                                                                                Mulai</label>
                                                                                            <input type="date"
                                                                                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                                                                name="tanggal_mulai"
                                                                                                required>
                                                                                            @error('tanggal_mulai')
                                                                                                <span class="invalid-feedback"
                                                                                                    role="alert"><strong>{{ $message }}</strong></span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-6 mb-3">
                                                                                            <label
                                                                                                class="form-label">Tanggal
                                                                                                Selesai</label>
                                                                                            <input type="date"
                                                                                                class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                                                                name="tanggal_selesai"
                                                                                                required>
                                                                                            @error('tanggal_selesai')
                                                                                                <span class="invalid-feedback"
                                                                                                    role="alert"><strong>{{ $message }}</strong></span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <label
                                                                                                class="form-label">Alasan</label>
                                                                                            <textarea class="form-control @error('alasan') is-invalid @enderror" name="alasan" rows="3"
                                                                                                placeholder="Tuliskan alasan cuti kamu..." required></textarea>
                                                                                            @error('alasan')
                                                                                                <span class="invalid-feedback"
                                                                                                    role="alert"><strong>{{ $message }}</strong></span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex justify-content-end">
                                                                                        <button type="button"
                                                                                            class="btn btn-secondary me-2"
                                                                                            data-bs-dismiss="modal">Tutup</button>
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

    @push('scripts')
        <!-- Bootstrap 5 Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const kategoriSelect = document.getElementById('kategori_cuti');
                const hplSection = document.getElementById('hpl_section');
                const hplInput = document.getElementById('hpl_input');
                const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]');
                const tanggalSelesai = document.querySelector('input[name="tanggal_selesai"]');

                kategoriSelect.addEventListener('change', function() {
                    if (this.value === 'Cuti melahirkan') {
                        hplSection.style.display = 'block';
                    } else {
                        hplSection.style.display = 'none';
                        hplInput.value = '';
                        tanggalMulai.value = '';
                        tanggalSelesai.value = '';
                    }
                });

                hplInput.addEventListener('change', function() {
                    const hplDate = new Date(this.value);
                    if (!isNaN(hplDate)) {
                        const mulai = new Date(hplDate);
                        mulai.setDate(hplDate.getDate() - 30); // 30 hari sebelum HPL

                        tanggalMulai.value = mulai.toISOString().split('T')[0];
                        tanggalSelesai.value = hplDate.toISOString().split('T')[0];
                    }
                });
            });
        </script>
    @endpush
