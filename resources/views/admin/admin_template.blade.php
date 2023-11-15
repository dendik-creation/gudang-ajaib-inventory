<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>




    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="/assets/extensions/toastify-js/src/toastify.css">
</head>

<body>
    <script src="/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="fs-5 mb-0">Gudang Ajaib</h1>
                        <div class="theme-toggle d-flex gap-2  align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item {{ Request::is('admin') ? 'active' : '' }}">
                            <a href="/admin" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li
                            class="sidebar-item has-sub {{ Request::is('admin/barang-gudang') || Request::is('admin/stok-barang') || Request::is('admin/data-siswa') || Request::is('admin/data-umum') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-database-fill-gear"></i>
                                <span>Master Data</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item {{ Request::is('admin/barang-gudang') ? 'active' : '' }}">
                                    <a href="/admin/barang-gudang" class="submenu-link">Barang Gudang</a>

                                </li>

                                <li class="submenu-item {{ Request::is('admin/stok-barang') ? 'active' : '' }} ">
                                    <a href="/admin/stok-barang" class="submenu-link">Stok Barang</a>
                                </li>

                                <li class="submenu-item {{ Request::is('admin/data-siswa') ? 'active' : '' }} ">
                                    <a href="/admin/data-siswa" class="submenu-link">Data Siswa</a>
                                </li>
{{--
                                <li class="submenu-item {{ Request::is('admin/data-umum') ? 'active' : '' }} ">
                                    <a href="/admin/data-umum" class="submenu-link">Data Umum {{ "(Guru, Dll.)" }}</a>
                                </li> --}}
                            </ul>
                        </li>

                        <li
                            class="sidebar-item has-sub {{ Request::is('admin/barang-terpinjam') || Request::is('admin/barang-kembali') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-receipt-cutoff"></i>
                                <span>Transaksi Data</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item {{ Request::is('admin/barang-terpinjam') ? 'active' : '' }}">
                                    <a href="/admin/barang-terpinjam" class="submenu-link">Barang Terpinjam</a>
                                </li>

                                {{-- <li class="submenu-item {{ Request::is('admin/barang-terpinjam-umum') ? 'active' : '' }}">
                                    <a href="/admin/barang-terpinjam-umum" class="submenu-link">Barang Terpinjam {{ ('Umum') }}</a>
                                </li> --}}

                                <li class="submenu-item {{ Request::is('admin/barang-kembali') ? 'active' : '' }} ">
                                    <a href="/admin/barang-kembali" class="submenu-link">Barang Kembali</a>
                                </li>
                            </ul>
                        </li>




                        {{-- Fixed Date --}}
                        {{-- <li class="sidebar-item position-fixed" style="bottom: 1em; cursor : default;">
                            <div class="sidebar-link">
                                <i class="bi bi-calendar-fill"></i>
                                <div class="d-flex flex-column gap-1">
                                    <span id="current_date">Gudang</span>
                                    <span class="w-100 bg-secondary" style="height: 2px"></span>
                                    <span id="current_time">Ajaib</span>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading d-flex justify-content-between align-items-center">
                <h3>{{ $title }}</h3>
                <div class="btn-group mb-1">
                    <div class="dropdown">
                        <button type="button"
                            class="btn btn-sm dropdown-toggle d-flex justify-content-center align-items-center"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar bg-success me-2">
                                <img src="/assets/compiled/jpg/2.jpg" alt="" srcset="">
                                <span class="avatar-status bg-success"></span>
                            </div>
                            <span class="me-1">Holla, {{ auth()->user()->nama }}</span>
                        </button>
                        <div class="dropdown-menu me-3">
                            <form method="POST" action="{{ url('/logout') }}" id="logout_form"
                                data-bs-toggle="modal" data-bs-target="#border-less-logout">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                @yield('content_admin')
            </div>
        </div>
    </div>

    {{-- Logout Modals --}}
    <div class="modal fade text-left modal-borderless" id="border-less-logout" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Logout</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Apakah Anda Ingin Logout
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tidak</span>
                    </button>
                    <button type="button" class="btn btn-light-primary ms-1" id="confirm_yes"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Ya, Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/extensions/toastify-js/src/toastify.js"></script>

    <script>
        const logoutForm = document.getElementById("logout_form");
        const confirmYes = document.getElementById("confirm_yes");
        logoutForm.addEventListener('submit', (e) => {
            e.preventDefault();
            confirmYes.addEventListener('click', () => {
                logoutForm.submit()
            });
        });

        // function updateClock() {
        //     const currentDate = document.getElementById('current_date');
        //     const currentTime = document.getElementById('current_time');
        //     const now = new Date();

        //     const day = now.getDate();
        //     const month = now.toLocaleString('default', {
        //         month: 'short'
        //     });
        //     const year = now.getFullYear();
        //     const hours = now.getHours().toString().padStart(2, '0');
        //     const minutes = now.getMinutes().toString().padStart(2, '0');
        //     const seconds = now.getSeconds().toString().padStart(2, '0');

        //     currentDate.innerHTML = `${day} ${month} ${year}`;
        //     currentTime.innerHTML = `${hours} : ${minutes} : ${seconds}`;
        // }
        // updateClock();
        // setInterval(updateClock, 1000);
    </script>

<script>
    function toastResult(gravity, position, text, status) {
        Toastify({
            text: text,
            duration: 3000,
            close: true,
            gravity: gravity,
            position: position,
            backgroundColor: status == 'failed' ? "#dc3545" : "#4fbe87",
        }).showToast();
    }
    </script>
    <script src="/assets/static/js/components/dark.js"></script>
    <script src="/assets/compiled/js/app.js"></script>

</body>

</html>
