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
                                    <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                        data-bs-target="#createModal">Tambah Pegawai</button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-traffic mb-0">

                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Jabatan</th>
                                                <th>NIP</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @php $i=1; @endphp
                                            @foreach ($pegawai as $data)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->jabatan ? $data->jabatan->jabatan : 'Tidak ada jabatan' }}
                                                    </td>
                                                    <td>{{ $data->nip }}</td>
                                                    <td>
                                                        @if ($data->status_pegawai == 1)
                                                            <span class="badge bg-primary-subtle text-primary fw-semibold"
                                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Aktif</span>
                                                        @else
                                                            <span class="badge bg-danger-subtle text-danger fw-semibold"
                                                                style="font-size: 0.75rem; padding: 5px 5px; border-radius: 3px;">Tidak
                                                                Aktif</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <form action="{{ route('pegawai.destroy', $data->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            {{-- <a href="{{ route('pegawai.edit', $data->id) }}"
                                                                aria-label="anchor"
                                                                class="btn btn-sm bg-primary-subtle me-1"
                                                                data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>

                                                            </a> --}}
                                                            <a href="{{ route('pegawai.show', $data->id) }}"
                                                                aria-label="anchor"
                                                                class="btn btn-sm bg-warning-subtle me-1"
                                                                data-bs-toggle="tooltip" data-bs-original-title="show">
                                                                <i class="mdi mdi-eye-outline fs-14 text-warning"></i>

                                                            </a>
                                                            <button type="sumbit" onclick="confirm('hapus')"
                                                                aria-label="anchor" class="btn btn-sm bg-danger-subtle"
                                                                data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>


                                                <!-- Modals -->
                                                <div class="modal fade bs-example-modal-center" id="createModal"
                                                    tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                 <h5 class="modal-title">Tambah Data Pegawai</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('pegawai.store') }}" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="name"
                                                                                class="form-label">Nama</label>
                                                                            <input type="text" id="name"
                                                                                name="name" class="form-control"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="email"
                                                                                class="form-label">Email</label>
                                                                            <input type="email" id="email"
                                                                                name="email" class="form-control"
                                                                                required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="password"
                                                                                class="form-label">Password</label>
                                                                            <input type="password" id="password"
                                                                                name="password" class="form-control"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="jabatan"
                                                                                class="form-label">Jabatan</label>
                                                                            <select id="jabatan" name="id_jabatan"
                                                                                class="form-control">
                                                                                @foreach ($jabatan as $data)
                                                                                    <option value="{{ $data->id }}">
                                                                                        {{ $data->jabatan }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="nip"
                                                                                class="form-label">NIP</label>
                                                                            <input type="text" id="nip"
                                                                                name="nip" class="form-control"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="telepon"
                                                                                class="form-label">Telepon</label>
                                                                            <input type="text" id="telepon"
                                                                                name="telepon" class="form-control"
                                                                                required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="jenis_kelamin"
                                                                                class="form-label">Jenis Kelamin</label>
                                                                            <select id="jenis_kelamin"
                                                                                name="jenis_kelamin" class="form-control">
                                                                                <option value="L">Laki-laki</option>
                                                                                <option value="P">Perempuan</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="tempat_lahir"
                                                                                class="form-label">Tempat Lahir</label>
                                                                            <input type="text" id="tempat_lahir"
                                                                                name="tempat_lahir" class="form-control"
                                                                                required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="tgl_lahir"
                                                                                class="form-label">Tanggal Lahir</label>
                                                                            <input type="date" id="tgl_lahir"
                                                                                name="tgl_lahir" class="form-control"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="agama"
                                                                                class="form-label">Agama</label>
                                                                            <select id="agama" name="agama"
                                                                                class="form-control">
                                                                                <option value="Islam">Islam</option>
                                                                                <option value="Kristen">Kristen</option>
                                                                                <option value="Katolik">Katolik</option>
                                                                                <option value="Budha">Budha</option>
                                                                                <option value="Hindu">Hindu</option>
                                                                                <option value="Konghuchu">Konghuchu
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-3">
                                                                            <label for="alamat"
                                                                                class="form-label">Alamat</label>
                                                                            <input type="text" id="alamat"
                                                                                name="alamat" class="form-control"
                                                                                required>
                                                                        </div>
                                                                    </div>


                                                                    <div class="mb-3">
                                                                        <label class="form-label">Profile</label>
                                                                        <input type="file" name="profile"
                                                                            class="form-control">
                                                                    </div>

                                                                    <div class="d-flex justify-content-end">
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

                                </div> <!-- end card-body -->
                            </div>
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
@endsection
