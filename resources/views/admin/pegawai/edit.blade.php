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
                        <form action="{{ route('pegawai.update', $pegawai->id) }} " method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" value="{{ old('name', $pegawai->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" name="name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" value="{{ old('email', $pegawai->email) }}" name="email"
                                        class="form-control" id="inputEmail">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="Password">
                                </div>
                            </div>
                            <label class="form-label">Jabatan</label>
                            <select name="id_jabatan" class="form-control">
                                <option selected disabled>-- Pilih Jabatan --</option>
                                @foreach ($jabatan as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $data->id == $pegawai->id_jabatan ? 'selected' : '' }}>
                                        {{ $data->jabatan }}</option>
                                @endforeach
                            </select>
                            <div class="row mb-3">
                                <label class="form-label">Nip</label>
                                <input type="text" value="{{ old('nip', $pegawai->nip) }}"
                                    class="form-control @error('nip') is-invalid @enderror" name="nip" required>
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Telepon</label>
                                <input type="text" value="{{ old('telepon', $pegawai->telepon) }}"
                                    class="form-control @error('telepon') is-invalid @enderror" name="telepon" required>
                                @error('telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ $pegawai->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="P" {{ $pegawai->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text"
                                    value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" class="form-control
                                    @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" required>
                                @error('tempat_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date"
                                    value="{{ old('tgl_lahir', $pegawai->tgl_lahir) }}" class="form-control
                                    @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" required>
                                @error('tgl_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                                <select id="agama" name="agama" required
                                    class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Konghuchu">Konghuchu</option>
                                </select>
                                @error('agama')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" value="{{ old('alamat', $pegawai->alamat) }}" class="form-control
                                    @error('alamat') is-invalid @enderror" name="alamat" required>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label for="status_pegawai" class="block text-sm font-medium text-gray-700">Status
                                    Pegawai</label>
                                <select name="status_pegawai" class="form-control">
                                    <option selected disabled>-- Pilih Status Pegawai --</option>
                                    <option value="1" {{ $pegawai->status_pegawai == 1 ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ $pegawai->status_pegawai == 0 ? 'selected' : '' }}>Tidak
                                        Aktif
                                    </option>
                                </select>
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
