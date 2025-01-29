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
                        <form action="{{ route('pengajuanCuti.store') }} " method="POST" enctype="multipart/form-data">
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
                                <label class="form-label">Tanggal Pengajuan</label>
                                <input type="date" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" name="tanggal_pengajuan"
                                    required>
                                @error('tanggal_pengajuan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Kategori Cuti</label>
                                <select id="kategori_cuti" name="kategori_cuti" required
                                    class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm">
                                    <option value="izin">Izin</option>
                                    <option value="cuti">Cuti</option>
                                </select>
                                @error('kategori_cuti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                    name="tanggal_mulai" required>
                                @error('tanggal_mulai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="row mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                name="tanggal_selesai" required>
                            @error('tanggal_selesai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label class="form-label">Alasan</label>
                            <input type="text" class="form-control @error('alasan') is-invalid @enderror"
                                name="alasan" required>
                            @error('alasan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <a href="{{ route('pengajuanCuti.index') }} " class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
