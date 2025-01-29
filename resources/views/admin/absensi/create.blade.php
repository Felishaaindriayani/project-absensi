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
                        <form action="{{ route('absensi.store') }} " method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                            <label class="form-label">Nama</label>
                            <select type="text" class="form-control" name="id_user">
                                @foreach ($pegawai as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                                    required>
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Jam masuk</label>
                                <input type="text" class="form-control @error('jam_masuk') is-invalid @enderror"
                                    name="jam_masuk" required>
                                @error('jam_masuk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Jam Keluar</label>
                                <input type="text" class="form-control @error('jam_keluar') is-invalid @enderror"
                                    name="jam_keluar" required>
                                @error('jam_keluar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="row mb-3">
                            <label class="form-label">Jam kerja</label>
                            <input type="text" class="form-control @error('jam_kerja') is-invalid @enderror"
                                name="jam_kerja" required>
                            @error('jam_kerja')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <a href="{{ route('absensi.index') }} " class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
