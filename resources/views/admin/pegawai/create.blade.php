@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">General Elements</h4>
                    </div>

                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">General Elements</li>
                        </ol>
                    </div>
                </div>

                <!-- General Form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title mb-0">Input Type</h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form action="{{ route('pegawai.store') }} " method="POST"
                                            enctype="multipart/form-data" class="w-100">
                                            @csrf
                                            <div class="mb-4">
                                                <label for="name"
                                                    class=" block text-sm font-medium text-gray-700">Name</label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="email"
                                                    class="from-label block text-sm font-medium text-gray-700">Email</label>
                                                <input id="email" type="email" name="email"
                                                    class="form-control mt-1 block w-full px-4 py-2 border rounded-md shadow-sm">
                                                @error('email')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>


                                            <div class="mb-4">
                                                <label for="password"
                                                    class="from-label block text-sm font-medium text-gray-700">password</label>
                                                <input id="password" type="password" name="password"
                                                    class="form-control mt-1 block w-full px-4 py-2 border rounded-md shadow-sm">
                                                @error('password')
                                                    <strong>{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <hr class="my-4">

                                            <p class="text-lg font-semibold text-gray-800 mb-4">Biodata Karyawan</p>

                                            <div class="row g-4">
                                                <div class="col-md-6">
                                                    <label for="jabatan"
                                                        class="block text-sm font-medium text-gray-700">Jabatan</label>
                                                    <select id="jabatan" name="id_jabatan" class="form-control">
                                                        @foreach ($jabatan as $data)
                                                            <option value="{{ $data->id }}">{{ $data->jabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="nip"
                                                        class="block text-sm font-medium text-gray-700">NIP</label>
                                                    <input id="nip" type="text" class="form-control" name="nip"
                                                        required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="telepon"
                                                        class="block text-sm font-medium text-gray-700">Telepon</label>
                                                    <input id="telepon" type="text" class="form-control" name="telepon"
                                                        required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="jenis_kelamin"
                                                        class="block text-sm font-medium text-gray-700">Jenis
                                                        Kelamin</label>
                                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                                                        <option value="L">Laki-laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="tempat_lahir"
                                                        class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                                    <input id="tempat_lahir" type="text" class="form-control"
                                                        name="tempat_lahir" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="tgl_lahir"
                                                        class="block text-sm font-medium text-gray-700">Tanggal
                                                        Lahir</label>
                                                    <input id="tgl_lahir" type="date" class="form-control"
                                                        name="tgl_lahir" required>
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="agama"
                                                        class="block text-sm font-medium text-gray-700">Agama</label>
                                                    <select id="agama" name="agama" class="form-control">
                                                        <option value="Islam">Islam</option>
                                                        <option value="Kristen">Kristen</option>
                                                        <option value="Katolik">Katolik</option>
                                                        <option value="Budha">Budha</option>
                                                        <option value="Hindu">Hindu</option>
                                                        <option value="Konghuchu">Konghuchu</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="alamat"
                                                        class="block text-sm font-medium text-gray-700">Alamat</label>
                                                    <input id="alamat" type="text" class="form-control"
                                                        name="alamat" required>
                                                </div>
                                            </div>



                                            <div class="mb-4">
                                                <label class=" block text-sm font-medium text-gray-700">profile</label>
                                                <input type="file" class="form-control" name="profile">
                                            </div>


                                            <a href="{{ route('pegawai.index') }} " class="btn btn-primary">Back</a>
                                            <button type="submit" class="btn btn-primary">Save</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
