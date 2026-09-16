<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Penggajian')
    </title>

    {{-- BOOTSTRAP --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        /* =========================
           DASAR
        ========================= */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fa;
            color: #212529;
            font-family: Arial, sans-serif;
        }


        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 230px;
            min-height: 100vh;

            background: #1f3b5b;

            position: fixed;
            left: 0;
            top: 0;

            padding: 20px;

            z-index: 1050;

            transition: 0.3s;
        }

        .sidebar h4 {
            color: white;
            margin-bottom: 30px;
            font-size: 20px;
        }

        .sidebar a {
            display: block;

            color: #dce6f0;

            text-decoration: none;

            padding: 10px 12px;

            border-radius: 6px;

            margin-bottom: 5px;

            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #31577e;
            color: white;
        }

        .sidebar hr {
            margin-top: 20px;
            margin-bottom: 15px;
        }


        /* =========================
           LOGOUT
        ========================= */

        .sidebar .btn-logout {
            color: #dce6f0 !important;

            text-decoration: none;

            padding: 10px 12px !important;

            width: 100%;

            text-align: left;
        }

        .sidebar .btn-logout:hover {
            background: #31577e;
            color: white !important;
        }


        /* =========================
           CONTENT
        ========================= */

        .content {
            margin-left: 230px;

            min-height: 100vh;

            transition: 0.3s;
        }


        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            background: white;

            border-bottom: 1px solid #ddd;

            min-height: 65px;
        }

        .navbar-title {
            font-weight: bold;
        }


        /* =========================
           BUTTON MENU MOBILE
        ========================= */

        .btn-menu {
            display: none;

            border: none;

            background: #1f3b5b;

            color: white;

            width: 40px;
            height: 40px;

            border-radius: 6px;

            font-size: 20px;
        }


        /* =========================
           OVERLAY MOBILE
        ========================= */

        .sidebar-overlay {
            display: none;

            position: fixed;

            left: 0;
            top: 0;

            width: 100%;
            height: 100%;

            background: rgba(0, 0, 0, 0.4);

            z-index: 1040;
        }


        /* =========================
           CARD
        ========================= */

        .card {
            border-radius: 8px;
        }


        /* =========================
           BUTTON
        ========================= */

        .btn-primary {
            background: #315f8f;
            border-color: #315f8f;
        }

        .btn-primary:hover {
            background: #274d75;
            border-color: #274d75;
        }


        /* =========================
           TABLE
        ========================= */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }


        /* =========================
           TABLET
        ========================= */

        @media (max-width: 991px) {

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .btn-menu {
                display: inline-flex;

                align-items: center;
                justify-content: center;
            }

            .sidebar-overlay.show {
                display: block;
            }

            main {
                padding: 20px !important;
            }
        }


        /* =========================
           HP
        ========================= */

        @media (max-width: 576px) {

            .navbar {
                padding: 12px 15px !important;
            }

            .navbar-title {
                font-size: 16px;
            }

            main {
                padding: 15px !important;
            }

            .sidebar {
                width: 250px;
            }

            .card-body {
                padding: 15px;
            }

            h3 {
                font-size: 21px;
            }

            h4 {
                font-size: 19px;
            }

            h5 {
                font-size: 17px;
            }

            .btn {
                font-size: 14px;
            }
        }

    </style>

</head>


<body>


{{-- =========================
     SIDEBAR
========================= --}}

<div
    class="sidebar"
    id="sidebar"
>

    <h4>
        Sistem Penggajian
    </h4>


    {{-- DASHBOARD --}}
    <a href="{{ route('dashboard') }}">
        Dashboard
    </a>


    {{-- DATA KARYAWAN --}}
    <a href="{{ route('karyawan.index') }}">
        Data Karyawan
    </a>


    {{-- DATA PERIODE --}}
    <a href="{{ route('periode.index') }}">
        Data Periode
    </a>


    {{-- PENGGAJIAN --}}
    <a href="{{ route('penggajian.index') }}">
        Penggajian
    </a>


    {{-- RIWAYAT --}}
    <a href="{{ route('riwayat.index') }}">
        Riwayat Penggajian
    </a>


    <hr class="text-secondary">


    {{-- LOGOUT --}}
    <form
        action="{{ route('logout') }}"
        method="POST"
    >

        @csrf

        <button
            type="submit"
            class="btn btn-link btn-logout"
        >
            Logout
        </button>

    </form>

</div>


{{-- OVERLAY --}}
<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>



{{-- =========================
     CONTENT
========================= --}}

<div class="content">


    {{-- =========================
         NAVBAR
    ========================= --}}

    <nav class="navbar px-4 py-3">

        <div class="d-flex align-items-center gap-3">

            {{-- TOMBOL MENU HP --}}
            <button
                type="button"
                class="btn-menu"
                id="btnMenu"
            >
                ☰
            </button>


            {{-- JUDUL --}}
            <strong class="navbar-title">
                @yield('title', 'Dashboard')
            </strong>

        </div>

    </nav>



    {{-- =========================
         MAIN
    ========================= --}}

    <main class="p-4">


        {{-- PESAN BERHASIL --}}
        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- PESAN ERROR --}}
        @if (session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif


        {{-- ISI HALAMAN --}}
        @yield('content')


    </main>

</div>



{{-- =========================
     BOOTSTRAP JS
========================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>



{{-- =========================
     SIDEBAR RESPONSIVE
========================= --}}

<script>

    const sidebar =
        document.getElementById('sidebar');

    const btnMenu =
        document.getElementById('btnMenu');

    const sidebarOverlay =
        document.getElementById('sidebarOverlay');


    function bukaSidebar()
    {
        sidebar.classList.add('show');

        sidebarOverlay.classList.add('show');
    }


    function tutupSidebar()
    {
        sidebar.classList.remove('show');

        sidebarOverlay.classList.remove('show');
    }


    btnMenu.addEventListener(
        'click',
        function ()
        {
            if (sidebar.classList.contains('show'))
            {
                tutupSidebar();
            }
            else
            {
                bukaSidebar();
            }
        }
    );


    sidebarOverlay.addEventListener(
        'click',
        function ()
        {
            tutupSidebar();
        }
    );


    // Tutup sidebar setelah memilih menu
    const menuSidebar =
        sidebar.querySelectorAll('a');


    menuSidebar.forEach(
        function (menu)
        {
            menu.addEventListener(
                'click',
                function ()
                {
                    if (window.innerWidth <= 991)
                    {
                        tutupSidebar();
                    }
                }
            );
        }
    );

</script>


</body>

</html>