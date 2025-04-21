            <div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="{{asset('admin/assets/images/logo-2.png')}}" alt="" height="100" width="200">
                                </span>
                            </a>
                        </div>

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
                                <li>
                                    <a href="{{ route('laporan.absensi') }}" class="tp-link">
                                        <i class="mdi mdi-archive-arrow-down-outline"></i>
                                        <span>Laporan</span>
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
                                <a class="nav-link "
                                    href="{{ route('pengajuanCuti.index') }}">
                                        <i class="mdi mdi-archive-arrow-down-outline"></i>
                                    <span>Pengajuan Cuti</span>
                                    @role('admin')
                                    @if (isset($meetNotification) && $meetNotification->count() > 0)
                                        <span class="badge bg-danger ms-2">{{ $meetNotification->count() }}</span>
                                    @endif
                                    @endrole
                                </a>
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
