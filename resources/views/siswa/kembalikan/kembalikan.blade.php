@extends('siswa.template_siswa')
@section('content')
    @include('alert')
    <style>

        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition-duration: 0.001s !important;
            }
        }

        .card-fara-data {
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
        .animate-icons::before{
            animation: icons 0.6s ease
        }

        @keyframes icons{
            0%{
                transition: all ease 0.3s;
                transform: translateY(200px);
            }
            100%{
                transition: all ease 0.3s;
                transform: translateY(0px);
            }
        }
    </style>
    <div class="d-flex card-fara-data shadow-lg text-white justify-content-around align-items-center rounded bg-primary" style="height: 500px;">
        <div class="position-relative overflow-hidden h-100">
            <i class="bi bi-archive text-white ms-5 opacity-50 animate-icons" style="font-size: 30em;"></i>
        </div>
        <form method="GET" action="{{ url('kembalikan_confirm') }}" class="w-50 mx-3">
            <h2 class="mb-3 text-white">Pengembalian Barang Gudang Ajaib TJKT</h2>
            <div class="mb-3">
                <input type="text" autocomplete="off" autofocus required name="nis" id="nis" class="form-control"
                    placeholder="Masukkan NIS">
            </div>
            <center>
                <button type="submit"
                    class="btn btn-success fw-bold border border-2 border-light p-2 rounded btn-sm w-50">Berikutnya</button>
            </center>
        </form>
    </div>
@endsection
