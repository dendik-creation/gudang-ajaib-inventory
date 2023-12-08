@extends('admin.admin_template')
@section('content_admin')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
    <link rel="stylesheet" href="/assets/extensions/filepond/filepond.css">


    <div class="row">
        <div class="col-12">
            @include('alert')
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Siswa Gudang TJKT</h4>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBarangModal"
                            onclick="kelasReady()">
                            <i class="bi bi-plus-square-fill mb-2 me-1"></i>
                            <small>Siswa Baru</small>
                        </button>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importBarang">
                            <i class="bi bi-file-earmark-arrow-up-fill mb-2 me-1"></i>
                            <small>Import Data Siswa</small>
                        </button>
                        <button class="btn btn-light-danger" data-bs-toggle="modal" data-bs-target="#perbaruiKelas">
                            <i class="bi bi-arrow-repeat mb-2 me-1"></i>
                            <small>Perbarui Kelas</small>
                        </button>
                        <a class="btn btn-warning" href="{{ url('/admin/data-siswa/export') }}" target="_blank">
                            <i class="bi bi-file-earmark-arrow-down-fill mb-2 me-1"></i>
                            <small>Export Data Siswa</small>
                        </a>
                        <a class="btn btn-success" href="{{ url('/admin/data-siswa/cetak') }}" target="_blank">
                            <i class="bi bi-printer-fill mb-2 me-1"></i>
                            <small>Cetak Semua ID Card</small>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-minimal">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->kelas->kelas }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center gap-2">
                                                <button class="btn btn-light-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editBarangModal" onclick="edit({{ $item->id }})">
                                                    <i class="bi bi-pencil-fill mb-2"></i>
                                                </button>
                                                <button class="btn btn-light-warning" data-bs-toggle="modal"
                                                    data-bs-target="#print_preview_modal"
                                                    onclick="generateQRCode('{{ $item->id }}', 'Konfirmasi Cetak ID Card Siswa')">
                                                    <i class="bi bi-printer-fill mb-2"></i>
                                                </button>
                                                <form method="POST" action="{{ url('admin/data-siswa/' . $item->id) }}"
                                                    data-bs-toggle="modal" id="delete_siswa_form_{{ $item->id }}"
                                                    onsubmit="confirmSubmit(event, {{ $item->id }})"
                                                    data-bs-target="#border-less">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light-danger">
                                                        <i class="bi bi-trash-fill mb-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modals --}}
    <div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Apakah Anda Yakin Menghapus Data Siswa
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tidak</span>
                    </button>
                    <button type="button" class="btn btn-light-primary ms-1" id="confirm_delete_yes"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Ya, Hapus</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Aksi Dicegah Modal --}}
    <div class="modal fade text-left" id="perbaruiKelas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel19">Konfirmasi Pembaruan Kelas</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="fs-6">Informasi terkait pembaruan kelas</h2>
                    <ul>
                        <li>Status kelas X & XI siswa-siswi akan dinaikkan 1 tingkat diatasnya</li>
                        <li>Status Kelas XII siswa-siswi akan diubah menjadi alumni</li>
                        <li>Pembaruan sedikit lama, mengingat jumlah data siswa banyak</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-sm-block d-none">Close</span>
                    </button>
                    <form action="{{ url('admin/data-siswa/update-kelas') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary ms-1 btn-sm" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-sm-block d-none">Perbarui Sekarang</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Import Siswa --}}
    <div class="modal fade text-left" id="importBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel19">Import Data Siswa</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ url('/admin/data-siswa/import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="mb-3">Import dari file Excel</div>
                            <input type="file" required accept=".xlsx" class="basic-filepond"
                                name="file_siswa" id="file_siswa">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-sm-block d-none">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1 btn-sm" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-sm-block d-none">Import</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- IDCard Preview --}}
    <div class="modal fade text-left" id="print_preview_modal" tabindex="-1" role="dialog"
        aria-labelledby="confirm_cetak_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="confirm_cetak_title">Konfirmasi Cetak Barcode / QrCode</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center flex-column align-items-center">
                        <div class="d-flex justify-content-center flex-column align-items-center gap-2" id="canvas_container"
                        {{-- style="width : 323px !important; height: 204px !important" --}}
                        >
                            <canvas id="print_preview_img" class=""></canvas>
                            <code id="siswa_nis" class="fs-3"></code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-sm-block d-none">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1 btn-sm" onclick="donwloadIDCard()"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-sm-block d-none">Download</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--Create Data Modal -->
    <div class="modal fade text-left" id="createBarangModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Siswa</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" onsubmit="store()">
                    @csrf
                    <div class="modal-body">
                        <label for="nis">NIS</label>
                        <div class="form-group">
                            <input required id="nis" name="nis" type="text" class="form-control">
                        </div>
                        <label for="nisn">NISN</label>
                        <div class="form-group">
                            <input required id="nisn" name="nisn" type="text" class="form-control">
                        </div>
                        <label for="nama">Nama Siswa</label>
                        <div class="form-group">
                            <input required id="nama" name="nama" type="text" class="form-control">
                        </div>
                        <label for="gender">Gender</label>
                        <div class="form-group">
                            <select required name="gender" id="gender" class="form-control">
                                <option value="" selected disabled>Pilih Gender</option>
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>

                        <label for="kelas_id">Kelas</label>
                        <div class="form-group">
                            <select required name="kelas_id" id="kelas_id" class="form-control">
                                <option value="" selected disabled>Pilih Kelas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Data Modals --}}
    <div class="modal fade text-left" id="editBarangModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Data Siswa</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" onsubmit="update()">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        <label for="edit_nis">NIS</label>
                        <div class="form-group">
                            <input required id="edit_nis" name="edit_nis" type="text" class="form-control">
                        </div>
                        <label for="edit_nisn">NISN</label>
                        <div class="form-group">
                            <input required id="edit_nisn" name="edit_nisn" type="text" class="form-control">
                        </div>
                        <label for="edit_nama">Nama Siswa</label>
                        <div class="form-group">
                            <input required id="edit_nama" name="edit_nama" type="text" class="form-control">
                        </div>
                        <label for="edit_gender">Gender</label>
                        <div class="form-group">
                            <select required name="edit_gender" id="edit_gender" class="form-control">
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>

                        <label for="edit_kelas_id">Kelas</label>
                        <div class="form-group">
                            <select required name="edit_kelas_id" id="edit_kelas_id" class="form-control">
                                <option value="" selected disabled>Pilih Kelas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- CDN Ra --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const canvasContainer = document.getElementById("canvas_container");
        const confirmCetakTitle = document.getElementById("confirm_cetak_title");
        const targetCode = document.getElementById("print_preview_img");
        const siswaNis = document.getElementById('siswa_nis');

        async function generateQRCode(id, title) {
            const siswa = await siswaGet(id);
            await new QRious({
                element: targetCode,
                background: '#ffffff',
                backgroundAlpha: 0,
                foreground: '#1c1c1c',
                foregroundAlpha: 1,
                level: 'H',
                padding: 10,
                size: 192,
                value: siswa.nis,
            });
            siswaNis.innerHTML = `${siswa.nis}`;
        }

        function siswaGet(id) {
            return fetch(`{{ url('/admin/data-siswa/${id}') }}`)
            .then(res => res.json())
            .then(result => result)
            .catch(err => console.log(err));
        }

        function donwloadIDCard() {
            html2canvas(canvasContainer).then(function(canvas) {
                const downloadLink = document.createElement('a');
                downloadLink.href = canvas.toDataURL('image/png');
                downloadLink.download = `IDCARD-${siswaName.innerHTML}`;
                downloadLink.click();
                downloadLink.remove();
            });
        }
    </script>

    <script>
        const confirmDeleteYes = document.getElementById("confirm_delete_yes");

        function confirmSubmit(e, id) {
            const deleteBarangForm = document.getElementById(`delete_siswa_form_${id}`);
            e.preventDefault();
            confirmDeleteYes.addEventListener('click', () => {
                deleteBarangForm.submit()
            });
        }
    </script>

    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
    <script src="/assets/extensions/filepond/filepond.js"></script>
    <script src="/assets/static/js/pages/filepond.js"></script>

    <script>
        function update() {
            const data = {
                _token: $("[name='_token']").val(),
                id: $("#edit_id").val(),
                nis: $("#edit_nis").val(),
                nisn: $("#edit_nisn").val(),
                nama: $("#edit_nama").val(),
                gender: $("#edit_gender").val(),
                kelas_id: $("#edit_kelas_id").val(),
            }
            $.ajax({
                type: "put",
                url: `{{ url('/admin/data-siswa/${data.id}') }}`,
                data: data,
                success: function(data) {
                    window.location.reload();
                },
                error: function() {
                    window.location.reload();
                }
            })
        }

        function store() {
            const data = {
                _token: $("[name='_token']").val(),
                nis: $("#nis").val(),
                nisn: $("#nisn").val(),
                nama: $("#nama").val(),
                gender: $("#gender").val(),
                kelas_id: $("#kelas_id").val(),
            }
            $.ajax({
                type: "post",
                url: "{{ url('admin/data-siswa') }}",
                data: data,
                success: function(data) {
                    window.location.reload();
                },
                error: function() {
                    window.location.reload();
                }
            })
        }

        function kelasReady(kelas_id) {
            $("#edit_kelas_id").empty();
            $("#kelas_id").empty();
            const optDefault = document.createElement('option');
            optDefault.value = "Fara";
            optDefault.innerHTML = "Pilih Kelas";
            $("#kelas_id").append(optDefault);
            $("#kelas_id").find('option[value="Fara"]').prop('disabled', true);
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/kelas') }}",
                success: function(data) {
                    data.forEach((item) => {
                        const opt = document.createElement('option');
                        opt.value = item.id;
                        opt.innerHTML = item.kelas;
                        $("#kelas_id").append(opt);
                        $(kelas_id).append(opt);
                    })
                }
            })
        }

        async function edit(id) {
            const tipeBarang = await kelasReady("#edit_kelas_id");

            await $.ajax({
                type: 'get',
                url: `{{ url('/admin/data-siswa/${id}') }}`,
                success: function(data) {
                    $("#edit_id").val(data.id);
                    $("#edit_nis").val(data.nis);
                    $("#edit_nisn").val(data.nisn);
                    $("#edit_nama").val(data.nama);
                    $("#edit_gender").val(data.gender);
                    $("#edit_kelas_id").val(data.kelas_id);
                }
            })
        }
    </script>
@endsection
