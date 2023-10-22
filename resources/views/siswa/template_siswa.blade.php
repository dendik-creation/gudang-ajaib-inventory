<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="./assets/extensions/toastify-js/src/toastify.css">
</head>

<body>
    <script>localStorage.setItem('theme', 'light')</script>
    <script src="assets/static/js/initTheme.js"></script>
    <nav class="navbar navbar-light main-navbar bg-white">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="/">
                <h1 class="fs-3 fw-bold">Gudang Ajaib TJKT</h1>
            </a>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ Request::is('pinjam*') ? 'active' : '' }}" href="/pinjam">Pinjam</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ Request::is('kembalikan*') ? 'active' : '' }}" id="kembalikan-tab"
                       href="/kembalikan">Kembalikan</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="/assets/extensions/toastify-js/src/toastify.js"></script>
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
