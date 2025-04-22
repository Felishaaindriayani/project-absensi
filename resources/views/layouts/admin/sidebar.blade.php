    <style>
        .logo-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            margin-right: 30px;
        }

        .logo-img {
            height: 60px;
            width: auto;
            margin-right: 5px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-right: 10px;
        }
    </style>


    <div class="app-sidebar-menu">
        <div class="h-100" data-simplebar>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <div class="logo-box">
                    <div class="logo-container">
                        <img src="{{ asset('admin/assets/images/logo-v3.png') }}" alt="Logo Workcheck" class="logo-img">
                        <span class="logo-text">WORKCHECK</span>
                    </div>
                </div>

                {{-- <div class="logo-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="{{asset('admin/assets/images/logo-2.png')}}" alt="" height="100" width="200">
                                    
                                </span>
                            </a>
                        </div> --}}

                <ul id="side-menu">

                    <li class="menu-title">Menu</li>

                    <li>
                        <a href="{{ route('home') }}">
                            <i data-feather="home"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    @if (Auth::user()->hasRole('admin'))
                        <li>
                            <a href="{{ route('jabatan.index') }}" class="tp-link">
                                <i class="mdi mdi-account-file-text-outline"></i>
                                <span>Jabatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pegawai.index') }}" class="tp-link">
                                <i class="mdi mdi-account-box-edit-outline"></i>
                                <span>Data Pegawai</span>
                            </a>
                        </li>
                        
                    @endif
                    <li>
                        <a href="{{ route('absensi.index') }}" class="tp-link">
                            <i class=" mdi mdi-book-open-variant-outline "></i>
                            <span>Absensi</span>
                        </a>

                    </li>
                    <li>
                        <a class="nav-link " href="{{ route('pengajuanCuti.index') }}">
                            <i class="mdi mdi-archive-arrow-down-outline"></i>
                            <span>Pengajuan Cuti</span>
                            @role('admin')
                                @if (isset($meetNotification) && $meetNotification->count() > 0)
                                    <span class="badge bg-danger ms-2">{{ $meetNotification->count() }}</span>
                                @endif
                            @endrole
                        </a>
                        @role('admin')
                        <li>
                            <a href="{{ route('laporan.absensi') }}" class="tp-link">
                                <i class="mdi mdi-archive-arrow-down-outline"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                        @endrole
                        {{-- <a href="{{ route('pengajuanCuti.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-envelope"></i>
                                    <p>
                                        Pengajuan Cuti
                                        @if (isset($cutiNotif) && $cutiNotif->count() > 0)
                                            <span class="right badge badge-danger">{{ $cutiNotif->count() }}</span>
                                        @endif
                                    </p>
                                </a> --}}
                    </li>
                    @role('user')
                        <li>
                            <a href="{{ route('pegawai.show', Auth::user()->id) }}" class="tp-link">
                                <i class="mdi mdi-account-outline"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                    @endrole


                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
    </div>
