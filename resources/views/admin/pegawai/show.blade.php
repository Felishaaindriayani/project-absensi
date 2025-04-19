@extends('layouts.admin')

@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Profile</h4>
                    </div>

                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Components</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <img src="{{ asset('admin/assets/images/small/user-image.jpg') }}"
                                class="rounded-top-2 img-fluid" alt="image data">

                            <div class="card-body">
                                <div class="align-items-center">

                                    <div class="silva-main-sections">
                                        <div class="silva-profile-main">
                                            @if ($pegawai->profile)
                                                <img src="{{ asset('/images/pegawai/' . $pegawai->profile) }}"
                                                    class="rounded-circle img-fluid avatar-xxl img-thumbnail float-start"
                                                    alt="image profile">
                                            @else
                                                <p>No photo available</p>
                                            @endif
                                        </div>
                                        <div class="overflow-hidden ms-md-4 ms-0">
                                            <h4 class="m-0 text-dark fs-20 mt-2 mt-md-0">{{ $pegawai->name }}</h4>
                                            <p class="my-1 text-muted fs-16">{{ $pegawai->nip }}</p>
                                            <span class="fs-15"><i
                                                    class="mdi mdi-message me-2 align-middle"></i><span>{{ $pegawai->email }}</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body pt-0">
                                <div class="tab-pane pt-4" id="profile_experience" role="tabpanel">
                                    <div class="row">

                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <h5 class="card-title text-black mb-0">Bioadata pegawai</h5>
                                            </div>
                                            @role('admin')
                                                <div class="float-end">
                                                    <a href="javascript:void(0)"
                                                        aria-label="anchor"class="btn btn-sm bg-primary-subtle me-1"
                                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $pegawai->id }}"
                                                        style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                                        <i class="mdi mdi-pencil-outline fs-14 text-primary"
                                                            data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                            data-bs-placement="left" data-bs-html="true" title="Update"></i>
                                                    </a>
                                                </div>
                                            @endrole
                                        </div>

                                        <hr>
                                        <!-- Pastikan Font Awesome sudah disertakan -->


                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row g-4">
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-user fa-lg text-primary me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Nama</strong><br>
                                                                {{ $pegawai->name }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i
                                                                class="fas fa-map-marker-alt fa-lg text-success me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Tempat Lahir</strong><br>
                                                                {{ $pegawai->tempat_lahir }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-envelope fa-lg text-danger me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Email</strong><br>
                                                                {{ $pegawai->email }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-calendar-alt fa-lg text-warning me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Tanggal Lahir</strong><br>
                                                                {{ $pegawai->tgl_lahir }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-briefcase fa-lg text-info me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Jabatan</strong><br>
                                                                {{ $pegawai->jabatan->jabatan }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-venus-mars fa-lg text-secondary me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Jenis Kelamin</strong><br>
                                                                {{ $pegawai->jenis_kelamin }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-id-card fa-lg text-dark me-3 mt-1"></i>
                                                            <div>
                                                                <strong>No Induk Pegawai</strong><br>
                                                                {{ $pegawai->nip }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-praying-hands fa-lg text-purple me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Agama</strong><br>
                                                                {{ $pegawai->agama }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-phone fa-lg text-teal me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Telepon</strong><br>
                                                                {{ $pegawai->telepon }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-start">
                                                            <i class="fas fa-home fa-lg text-muted me-3 mt-1"></i>
                                                            <div>
                                                                <strong>Alamat</strong><br>
                                                                {{ $pegawai->alamat }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div> <!-- end Experience -->


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modals -->
                <div class="modal fade bs-example-modal-center" id="editModal{{ $pegawai->id }}" tabindex="-1"
                    role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" value="{{ old('name', $pegawai->name) }}"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                required>
                                            @error('name')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" value="{{ old('email', $pegawai->email) }}"
                                                name="email" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Jabatan</label>
                                            <select name="id_jabatan" class="form-control">
                                                <option selected disabled>-- Pilih Jabatan --</option>
                                                @foreach ($jabatan as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ $data->id == $pegawai->id_jabatan ? 'selected' : '' }}>
                                                        {{ $data->jabatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">NIP</label>
                                            <input type="text" value="{{ old('nip', $pegawai->nip) }}"
                                                class="form-control @error('nip') is-invalid @enderror" name="nip"
                                                required>
                                            @error('nip')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Telepon</label>
                                            <input type="text" value="{{ old('telepon', $pegawai->telepon) }}"
                                                class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                                                required>
                                            @error('telepon')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="L"
                                                    {{ $pegawai->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki
                                                </option>
                                                <option value="P"
                                                    {{ $pegawai->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text"
                                                value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                name="tempat_lahir" required>
                                            @error('tempat_lahir')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" value="{{ old('tgl_lahir', $pegawai->tgl_lahir) }}"
                                                class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                name="tgl_lahir" required>
                                            @error('tgl_lahir')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Agama</label>
                                            <select name="agama" class="form-control">
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Konghuchu">Konghuchu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" value="{{ old('alamat', $pegawai->alamat) }}"
                                                class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                                required>
                                            @error('alamat')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status Pegawai</label>
                                            <select name="status_pegawai" class="form-control">
                                                <option value="1"
                                                    {{ $pegawai->status_pegawai == 1 ? 'selected' : '' }}>Aktif</option>
                                                <option value="0"
                                                    {{ $pegawai->status_pegawai == 0 ? 'selected' : '' }}>Tidak Aktif
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Profile</label>
                                            <input type="file" name="profile" class="form-control">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
