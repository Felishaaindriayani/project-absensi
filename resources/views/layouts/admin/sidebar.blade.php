            <div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-light.png" alt="" height="24">
                                </span>
                            </a>
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="24">
                                </span>
                            </a>
                        </div>

                        <ul id="side-menu">

                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="{{route('home')}}" >
                                    <i data-feather="home"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="apps-calendar.html" class="tp-link">
                                    <i data-feather="calendar"></i>
                                    <span> Calendar </span>
                                </a>
                            </li>
                            @if(Auth::user()->hasRole('admin'))
                                        <li>
                                            <a href="{{route('jabatan.index')}}" class="tp-link">
                                                <i class="mdi mdi-account-file-text-outline"></i>
                                                <span>Jabatan</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('pegawai.index')}}" class="tp-link">
                                                <i class="mdi mdi-account-box-edit-outline"></i>
                                                <span>Data Pegawai</span>
                                            </a>
                                        </li>
                                @endif
                                        <li>
                                            <a href="{{route('absensi.index')}}" class="tp-link">
                                                <i class=" mdi mdi-book-open-variant-outline "></i>
                                                <span>Absensi</span>
                                            </a>

                                        </li>
                                        <li>
                                            <a href="{{route('pengajuanCuti.index')}}" class="tp-link">
                                                <i class="mdi mdi-archive-arrow-down-outline"></i>
                                                <span>Pengajuan Cuti</span>
                                            </a>
                                        </li>
                        

                        </ul>
            
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
            </div>