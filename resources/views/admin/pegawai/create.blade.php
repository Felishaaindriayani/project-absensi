@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="col-lg-6">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Horizontal Form</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form action="{{ route('pegawai.store') }} " method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="inputEmail">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="Password">
                                </div>
                            </div>
                            <label class="form-label">Jabatan</label>
                            <select type="text" class="form-control" name="id_jabatan">
                                @foreach ($jabatan as $data)
                                    <option value="{{ $data->id }}">{{ $data->jabatan }}</option>
                                @endforeach
                            </select>
                            <div class="row mb-3">
                                <label class="form-label">Nip</label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip"
                                    required>
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                    name="telepon" required>
                                @error('telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                    name="jenis_kelamin" required>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    name="tempat_lahir" required>
                                @error('tempat_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    name="tgl_lahir" required>
                                @error('tgl_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Agama</label>
                                <input type="text" class="form-control @error('agama') is-invalid @enderror"
                                    name="agama" required>
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" required>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">profile</label>
                                <input type="file" class="form-control" name="profile">
                            </div>
                            <a href="{{ route('pegawai.index') }} " class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
