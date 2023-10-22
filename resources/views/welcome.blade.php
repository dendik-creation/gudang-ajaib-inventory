<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang Ajaib TJKT</title>
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css">
    <style>
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition-duration: 0.001s !important;
            }
        }

        .card-fara-data {
            --background-size: unquote('min(100vw, 40em)');
            background: linear-gradient(100deg, #402, #435ebe);
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 460 55'%3E%3Cg fill='none' fill-rule='evenodd' stroke='%23fff' stroke-width='7' opacity='.1'%3E%3Cpath d='M-345 34.5s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 48.3 0 48.3s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3Cpath d='M-345 20.7s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 34.5 0 34.5s115-13.8 115-13.8S172.5 6.9 230 6.9s115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8m-920 27.6s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 62.1 0 62.1s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3Cpath d='M-345 6.9s57.5-13.8 115-13.8S-115 6.9-115 6.9-57.5 20.7 0 20.7 115 6.9 115 6.9 172.5-6.9 230-6.9 345 6.9 345 6.9s57.5 13.8 115 13.8S575 6.9 575 6.9'/%3E%3Cpath d='M-345-6.9s57.5-13.8 115-13.8S-115-6.9-115-6.9-57.5 6.9 0 6.9 115-6.9 115-6.9s57.5-13.8 115-13.8S345-6.9 345-6.9 402.5 6.9 460 6.9 575-6.9 575-6.9m-920 69s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 75.9 0 75.9s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3C/g%3E%3C/svg%3E%0A"),
                linear-gradient(80deg, #402, #435ebe);
            background-position: 50% 50%;
            animation: background-move 8s linear infinite;
            background-size: 100vw auto, 100% 100%;
            background-size: unquote('max(100vw, 30em)') auto, 100% 100%;
            transition: all ease 0.3s;
        }

        .card-dendi-data:hover, .card-fara-data:hover{
            transition: all ease 0.3s;
            filter: brightness(120%)
        }

        .card-dendi-data {
            transition: all ease 0.3s;
            --background-size: unquote('min(100vw, 40em)');
            background: linear-gradient(100deg, #402, #198754);
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 460 55'%3E%3Cg fill='none' fill-rule='evenodd' stroke='%23fff' stroke-width='7' opacity='.1'%3E%3Cpath d='M-345 34.5s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 48.3 0 48.3s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3Cpath d='M-345 20.7s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 34.5 0 34.5s115-13.8 115-13.8S172.5 6.9 230 6.9s115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8m-920 27.6s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 62.1 0 62.1s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3Cpath d='M-345 6.9s57.5-13.8 115-13.8S-115 6.9-115 6.9-57.5 20.7 0 20.7 115 6.9 115 6.9 172.5-6.9 230-6.9 345 6.9 345 6.9s57.5 13.8 115 13.8S575 6.9 575 6.9'/%3E%3Cpath d='M-345-6.9s57.5-13.8 115-13.8S-115-6.9-115-6.9-57.5 6.9 0 6.9 115-6.9 115-6.9s57.5-13.8 115-13.8S345-6.9 345-6.9 402.5 6.9 460 6.9 575-6.9 575-6.9m-920 69s57.5-13.8 115-13.8 115 13.8 115 13.8S-57.5 75.9 0 75.9s115-13.8 115-13.8 57.5-13.8 115-13.8 115 13.8 115 13.8 57.5 13.8 115 13.8 115-13.8 115-13.8'/%3E%3C/g%3E%3C/svg%3E%0A"),
                linear-gradient(80deg, #402, #198754);
            background-position: 50% 50%;
            animation: background-move 8s linear infinite;
            background-size: 100vw auto, 100% 100%;
            background-size: unquote('max(100vw, 30em)') auto, 100% 100%;
        }

        @keyframes background-move {
            0% {
                background-position: 0 0, 0 0;
            }

            100% {
                background-position: 100vw 0, 0 0;
                background-position: unquote('max(100vw, 40em)') 0, 0 0;
            }
        }

        .animate-icons::before {
            animation: icons 0.6s ease
        }

        .animate-icons-reverse::before {
            animation: icons-reverse 0.6s ease alternate forwards;
            rotate: 180deg;
            transform: translateY(400px)
        }

        @keyframes icons {
            0% {
                transition: all ease 0.3s;
                transform: translateY(200px);
            }

            100% {
                transition: all ease 0.3s;
                transform: translateY(0px);
            }
        }

        @keyframes icons-reverse {
            to{
                transition: all ease 0.3s;
                transform: translateY(200px)
            }
        }
    </style>
</head>

<body>
    <script>
        localStorage.setItem('theme', 'light')
    </script>
    <script src="assets/static/js/initTheme.js"></script>
    <nav class="navbar navbar-light">
        <div class="container d-flex">
            <div class="navbar-brand">
                <h1 class="fs-3 fw-bold">Gudang Ajaib TJKT</h1>
            </div>
        </div>
    </nav>


    <div class="container">
        @include('alert')
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Halo, Saya adalah Bang Ajaib dari TJKT</h4>
            </div>
            <div class="card-body">
                <p>Saya merupakan aplikasi otomatis yang digunakan untuk memantau perubahan barang masuk dan barang
                    keluar dari gudang TJKT. Kamu bisa memilih tombol dibawah ini untuk meminjam suatu alat atau
                    mengembalikannya kembali ke gudang</p>
                <div class="d-flex justify-content-center position-relative overflow-hidden align-items-center gap-3">
                    <a href="/pinjam"
                        class="btn card-fara-data icon icon-left position-relative d-flex justify-content-center align-items-center w-100 btn-primary"
                        style="height: 300px">
                        <span class="fs-2 fw-bold">
                            <i class="bi bi-box-seam position-absolute opacity-25 top-0 animate-icons"
                                style="font-size: 10em; left : 0.45em"></i>
                                <div style="transform: translateY(-90px)">
                                    Peminjaman Barang
                                </div>
                        </span>
                    </a>
                    <a href="/kembalikan"
                        class="btn icon card-dendi-data icon-left d-flex position-relative justify-content-center align-items-center w-100 btn-success"
                        style="height: 300px">
                        <span class="fs-2 fw-bold">
                            <i class="bi bi-archive position-absolute opacity-25 top-0 animate-icons-reverse"
                                style="font-size: 10em; left : 0.45em;"></i>
                                <div style="transform: translateY(80px)">
                                    Pengembalian Barang
                                </div>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/compiled/js/app.js"></script>

</body>

</html>
