@extends('siswa.template_siswa')
@section('content')
    <style>
        #remove {
            cursor: pointer !important;
        }
        #submit_btn:disabled{
            cursor: not-allowed !important;
            pointer-events: initial;
            opacity: 50%;

        }
        #submit_btn{
            pointer-events: initial;
            cursor: pointer !important;
        }
        #submit_btn{
            height: 100px;
        }
    </style>

    <h1 class="fw-bold fs-4 mb-2">Konfirmasi Peminjaman Barang</h1>
    <div class="mt-4">
        <div class="container">
            <div class="d-flex justify-content-start align-items-start mb-2">
                <div class="w-50">
                    <table class="table me-5">
                        <tbody>
                            <tr>
                                <th scope="row">NIS</th>
                                <td>{{ $data->nis }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Gender</th>
                                <td>{{ $data->gender }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kelas</th>
                                <td>{{ $data->kelas->kelas }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <form method="POST" onsubmit="beforeSubmit()" class="mt-3" action="{{ url('pinjam') }}"
                        id="form_send">
                        @csrf
                        <input type="hidden" value="{{ $data->id }}" name="user_id" id="user_id">
                        <a href="/pinjam" class="btn btn-danger btn-sm w-100 mb-3">Batalkan</a>
                        <div class="mb-3">
                            <div class="mb-2"><small>Keterangan {{ '( Opsional )' }}</small></div>
                            <textarea name="keterangan" id="keterangan" cols="2" rows="4" class="form-control form-control-sm p-2"
                                placeholder="Misal untuk 1 kelas atau jumlah tertentu atau pesan"></textarea>
                        </div>
                        <div class="d-flex flex-column gap-5">
                            <button disabled type="submit" id="submit_btn" class="btn btn-primary">Konfirmasi Peminjaman</button>
                        </div>
                    </form>

                    <div class="mt-2">
                        @include('alert')
                    </div>
                </div>

                {{-- List --}}
                <div class="ms-5 w-75">
                    <h1 class="fw-medium fs-5 mb-3">List Barang Untuk Di Pinjam (Jangan Lupa Untuk Konfirmasi Peminjaman)</h1>
                    <form class="form-group" id="form_list">
                        <input required placeholder="Scan QR Code atau Barcode" autocomplete="off" autofocus type="text"
                            class="form-control form-control-sm" name="kode_barang" id="kode_barang">
                    </form>
                    <div class="container">
                        <ul class="list-group mt-4" id="list_barang">
                            {{-- <li class="list-group-item"></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/extensions/jquery/jquery.min.js"></script>

    <script>
        let list = [];
        let kode_barang = document.getElementById('kode_barang');
        let list_barang = document.getElementById('list_barang');
        let list_data = document.getElementById('list-data');
        let form_list = document.getElementById('form_list');
        let form_send = document.getElementById('form_send');
        let submit_btn = document.getElementById('submit_btn');

        form_list.addEventListener('submit', addList)

        function beforeSubmit() {
            list.forEach((item) => {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.value = item.kode_barang
                input.name = 'data[]';
                form_send.append(input);
            })
            submit_btn.setAttribute('disabled', true);
            submit_btn.innerHTML = 'Mengirim Data, Tunggu Sebentar...';
        }


        function readyBtn() {
            if (list.length > 0) {
                submit_btn.removeAttribute('disabled')
                submit_btn.innerHTML = 'Konfirmasi Peminjaman Barang';
            } else {
                submit_btn.setAttribute('disabled', true);
                submit_btn.innerHTML = 'Pinjam Setidaknya 1 Barang & Konfirmasi Peminjaman Di sini';
            }
        }
        readyBtn();

        function addList(e) {
            e.preventDefault();
            requestResult(kode_barang.value);
            kode_barang.value = "";
        }

        function requestResult(value) {
            $.ajax({
                type: 'get',
                url: "{{ url('/barang-check') }}",
                data: {
                    kode_barang: value,
                },
                success: function(data) {
                    if(list.length > 0){
                        if(list.find(item => item.id == data.id )){
                            toastResult("bottom", "right", "Barang ini telah masuk list anda", "failed")
                        }else{
                            list.push(data);
                            createList();
                            readyBtn();
                        }
                    }else{
                        list.push(data);
                        createList();
                        readyBtn();
                    }
                },
                error: function(xhr, status, err) {
                    toastResult("bottom", "right", xhr.responseJSON, "failed")
                }
            });
        }

        function createList() {
            list_barang.innerHTML = ""
            list.forEach((item, i) => {
                const li = document.createElement('li');
                li.classList.add('list-group-item');
                li.id = 'list-data';
                li.innerHTML =
                    `
                    <small class="position-relative">
                        <div class="position-absolute d-flex justify-content-center align-items-center h-100 top-50 translate-middle" style="left : -15px">
                            <div class="bg-light-success border border-warning rounded px-2 py-2 d-flex justify-content-center align-items-center">
                                <span class="fs-3">${i + 1}</span>
                            </div>
                        </div>

                        <div class="ms-4">
                            <div class="d-flex justify-content-start align-items-center mb-1">
                                <div class="fw-bold w-25">Kode Barang</div>
                                <code class="fs-6">${item.kode_barang}</code>
                            </div>
                            <div class="d-flex justify-content-start align-items-center mb-1">
                                <div class="fw-bold w-25">Nama Barang</div>
                                <div class="">${item.nama_barang}</div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center mb-1">
                                <div class="fw-bold w-25">Jumlah Barang</div>
                                <div class="">${item.jumlah_satuan} Buah</div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center mb-1">
                                <div class="fw-bold w-25">Status Barang</div>
                                <div class="text-capitalize">${item.status_barang}</div>
                            </div>
                        </div>

                        <div class="position-absolute end-0 h-100 top-0">
                            <button class="btn btn-danger h-100" onclick=removeIndex('${i}')>
                                <i class="bi bi-trash fs-4 mb-2"></i>
                            </button>
                        </div>
                    </small>
                `;
                list_barang.append(li);
            })
        }

        function removeIndex(i) {
            list.splice(i, 1);
            createList();
            readyBtn();
        }
    </script>
@endsection
