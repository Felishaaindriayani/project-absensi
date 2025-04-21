@extends('layouts.admin')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Data jabatan</h4>
                    </div>
                </div>
            </div>
            <!-- Tooltips -->
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="fw-bold py-3">Tambah jabatan</h5>
                            <form action="{{ route('jabatan.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" placeholder=""
                                        required>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="fw-bold py-3">Tabel Jabatan</h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @php $i=1; @endphp
                                        @foreach ($jabatan as $data)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $data->jabatan }}
                                                <td>
                                                    <form action="{{ route('jabatan.destroy', $data->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void(0)" aria-label="anchor"class="btn btn-sm bg-primary-subtle me-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $data->id }}"
                                                        style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                                        <i class="mdi mdi-pencil-outline fs-14 text-primary" data-bs-toggle="tooltip"
                                                            data-bs-offset="0,4" data-bs-placement="left"
                                                            data-bs-html="true" title="Update"></i>
                                                        </a>

                                                    <button
                                                        aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-confirm-delete="true"
                                                        style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                                        <i class="mdi mdi-delete fs-14 text-danger" data-bs-toggle="tooltip"
                                                            data-bs-offset="0,4" data-bs-placement="right"
                                                            data-bs-html="true" title="Delete"></i>
                                                    </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Jabatan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                     <form action="{{ route('jabatan.update', $data->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="jabatan" class="form-label">Nama Jabatan</label>
                                                                <input type="text" class="form-control" name="jabatan" value="{{ old('jabatan', $data->jabatan )}}"
                                                                required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                perubahan</button>
                                                        </div>
                                                    </form>
                                                </div> <!-- end modal content -->
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endsection
