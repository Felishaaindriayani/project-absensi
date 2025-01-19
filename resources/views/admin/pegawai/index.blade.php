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
                                            @foreach ($user as $data)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->jabatan }}</td>
                                                    <td>{{ $data->nip }}</td>
                                                    <td>
                                                        @if ($data->status_pegawai == 1)
                                                            <span class="badge bg-primary-subtle text-primary fw-semibold">— Pegawai Aktif —</span>
                                                        @else
                                                            <span class="badge bg-label-dark">— Pegawai Tidak Aktif —</span>
                                                        @endif
                                                    </td>
                                                    
                                                <td>
                                                    <form action="{{ route('pegawai.destroy', $data->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('pegawai.edit', $data->id) }}" aria-label="anchor"
                                                            class="btn btn-sm bg-primary-subtle me-1"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>

                                                        </a>
                                                        <a href="{{ route('pegawai.destroy', $data->id) }}"
                                                            aria-label="anchor" class="btn btn-sm bg-danger-subtle"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                        </a>
                                                    </form>
                                                </td>
                                                </tr>
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
        </div>
    @endsection
