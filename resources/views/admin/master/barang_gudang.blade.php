@extends('admin.admin_template')
@section('content_admin')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">

    <div class="row">
        <div class="col-12">
            @include('alert')
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>List Barang Gudang TJKT</h4>
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBarangModal"
                            onclick="tipeBarangReady()">
                            <i class="bi bi-plus-square-fill mb-2 me-1"></i>
                            <small>Barang Baru</small>
                        </button>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importBarang">
                            <i class="bi bi-file-earmark-arrow-up-fill mb-2 me-1"></i>
                            <small>Import Data Barang</small>
                        </button>
                        <a class="btn btn-warning" href="{{ url('/admin/barang-gudang/export') }}" target="_blank">
                            <i class="bi bi-file-earmark-arrow-down-fill mb-2 me-1"></i>
                            <small>Export Data Barang</small>
                        </a>
                        <div class="btn-group">
                            <div class="dropdown">
                                <button type="button" class="btn btn-success" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-printer-fill mb-2 me-1"></i>
                                    <small>Cetak Semua Kode</small>
                                </button>
                                <div class="dropdown-menu me-3">
                                    <form action="{{ url('/admin/barang-gudang/cetak') }}" method="GET" target="_blank">
                                        <input type="hidden" name="kode" value="qrcode">
                                        <button type="submit" id="qrcode_cetak_all"
                                        class="dropdown-item d-flex justify-content-start align-items-center gap-2">
                                         <i class="bi bi-qr-code mb-2"></i>
                                        <small>Cetak Semua QR Code</small>
                                    </button>
                                </form>
                                <form action="{{ url('/admin/barang-gudang/cetak') }}" method="GET" target="_blank">
                                    <input type="hidden" name="kode" value="barcode">
                                    <button type="submit" id="barcode_cetak_all"
                                            class="dropdown-item d-flex justify-content-start align-items-center gap-2"> <i
                                            class="bi bi-upc-scan mb-2"></i>
                                            <small>Cetak Semua Barcode</small>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive datatable-minimal">
                        <table class="table" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Tipe Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Status Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $i => $item)
                                    <tr>
                                        <td class="barcode-text">{{ $i + 1 }}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td class="text-capitalize">{{ $item->tipe_barang->tipe_barang }}</td>
                                        <td>{{ $item->jumlah_satuan }} Buah</td>
                                        <td>
                                            <div
                                                class="{{ $item->status_barang == 'ada' ? 'badge bg-light-primary' : 'badge bg-light-danger' }} text-capitalize">
                                                {{ $item->status_barang }}</div>
                                        </td>
                                        <td>
                                            @if ($item->status_barang == 'ada')
                                                <div class="d-flex justify-content-start align-items-center gap-2">
                                                    <button class="btn btn-light-primary" data-bs-toggle="modal"
                                                        data-bs-target="#editBarangModal"
                                                        onclick="edit({{ $item->id }})">
                                                        <i class="bi bi-pencil-fill mb-2"></i>
                                                    </button>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-light-warning"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="bi bi-printer-fill mb-2"></i>
                                                            </button>
                                                            <div class="dropdown-menu me-3">
                                                                <button type="button" id="qrcode_cetak"
                                                                    class="dropdown-item d-flex justify-content-start align-items-center gap-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#print_preview_modal"
                                                                    onclick="generateQRCode('{{ $item->kode_barang }}', 'Konfirmasi Cetak QR Code')">
                                                                    <i class="bi bi-qr-code mb-2"></i>
                                                                    <small>Cetak QR Code</small>
                                                                </button>
                                                                <button type="button" id="barcode_cetak"
                                                                    class="dropdown-item d-flex justify-content-start align-items-center gap-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#print_preview_modal"
                                                                    onclick="generateBarcode('{{ $item->kode_barang }}', 'Konfirmasi Cetak Barcode')">
                                                                    <i class="bi bi-upc-scan mb-2"></i>
                                                                    <small>Cetak Barcode</small>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form method="POST"
                                                    action="{{ url('admin/barang-gudang/' . $item->id) }}"
                                                    data-bs-toggle="modal" id="delete_barang_form_{{ $item->id }}"
                                                    onsubmit="confirmSubmit(event, {{ $item->id }})"
                                                    data-bs-target="#border-less">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light-danger">
                                                        <i class="bi bi-trash-fill mb-2"></i>
                                                    </button>
                                                </form>
                                                </div>
                                            @else
                                                <button class="btn w-100 btn-light-danger" data-bs-toggle="modal"
                                                    data-bs-target="#aksiDiCegah">
                                                    <i class="bi bi-ban mb-2"></i>
                                                    <span><small>Dicegah</small></span>
                                                </button>
                                            @endif
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
                        Apakah Anda Yakin Menghapus Barang
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
    <div class="modal fade text-left" id="aksiDiCegah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel19">Informasi Aksi Dicegah</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Barang harus digudang untuk melakukan edit atau hapus data
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-sm-block d-none">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1 btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-sm-block d-none">OK</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Import Barang --}}
    <div class="modal fade text-left" id="importBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel19">Import Data Barang</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ url('/admin/barang-gudang/import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="mb-3">Import dari file Excel</div>
                            <input type="file" required accept=".xlsx" class="form-control form-control-sm" name="file_barang" id="file_barang">
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

    {{-- Barcode / QrCode Preview --}}
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
                        <div class="d-flex flex-column align-items-center" id="canvas_container">
                            <canvas id="print_preview_img"></canvas>
                            <code id="print_preview_text" class="fs-4"></code>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-sm-block d-none">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1 btn-sm" onclick="downloadKodeBarang()"
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
                    <h4 class="modal-title" id="myModalLabel33">Tambah Barang</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" onsubmit="store()">
                    @csrf
                    <div class="modal-body">
                        <label for="kode_barang">Kode Barang</label>
                        <div class="form-group">
                            <input required id="kode_barang" name="kode_barang" type="text" class="form-control">
                        </div>
                        <label for="nama_barang">Nama Barang</label>
                        <div class="form-group">
                            <input required id="nama_barang" name="nama_barang" type="text" class="form-control">
                        </div>
                        <label for="satuan_barang">Satuan Barang</label>
                        <div class="form-group">
                            <select required name="satuan_barang" id="satuan_barang" class="form-control">
                                <option value="" selected disabled>Pilih Satuan</option>
                                <option value="satuan">Satuan</option>
                                <option value="kelompok">Kelompok</option>
                            </select>
                        </div>
                        <label for="jumlah_satuan">Jumlah Satuan</label>
                        <div class="form-group">
                            <input required id="jumlah_satuan" name="jumlah_satuan" type="number" class="form-control">
                        </div>

                        <label for="tipe_barang_id">Tipe Barang</label>
                        <div class="form-group">
                            <select required name="tipe_barang_id" id="tipe_barang_id" class="form-control">
                                <option value="" selected disabled>Pilih Tipe Barang</option>
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
                    <h4 class="modal-title" id="myModalLabel33">Edit Data Barang</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="#" onsubmit="update()">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="" id="edit_id">
                        <label for="kode_barang">Kode Barang</label>
                        <div class="form-group">
                            <input required id="edit_kode_barang" name="kode_barang" type="text"
                                class="form-control">
                        </div>
                        <label for="nama_barang">Nama Barang</label>
                        <div class="form-group">
                            <input required id="edit_nama_barang" name="nama_barang" type="text"
                                class="form-control">
                        </div>
                        <label for="satuan_barang">Satuan Barang</label>
                        <div class="form-group">
                            <select required name="satuan_barang" id="edit_satuan_barang" class="form-control">
                                <option value="" selected disabled>Pilih Satuan Barang</option>
                                <option value="satuan">Satuan</option>
                                <option value="kelompok">Kelompok</option>
                            </select>
                        </div>
                        <label for="jumlah_satuan">Jumlah Satuan</label>
                        <div class="form-group">
                            <input required id="edit_jumlah_satuan" name="jumlah_satuan" type="number"
                                class="form-control">
                        </div>

                        <label for="tipe_barang_id">Tipe Barang</label>
                        <div class="form-group">
                            <select required name="tipe_barang_id" id="edit_tipe_barang_id" class="form-control">
                                <option value="" selected disabled>Pilih Tipe Barang</option>
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
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const canvasContainer = document.getElementById("canvas_container");
        const confirmCetakTitle = document.getElementById("confirm_cetak_title");
        const targetCode = document.getElementById("print_preview_img");
        const canvasText = document.getElementById("print_preview_text");

        function generateBarcode(text, title) {
            JsBarcode(targetCode, text, {
                format: 'CODE128',
                displayValue: true,
                width: 3,
                height: 100,
            });
            canvasText.classList.add('d-none')
            canvasText.innerHTML = text;
            confirmCetakTitle.innerHTML = title;
        }

        function generateQRCode(text, title) {
            new QRious({
                element: targetCode,
                background: '#ffffff',
                backgroundAlpha: 1,
                foreground: '#000',
                foregroundAlpha: 1,
                level: 'H',
                padding: 25,
                size: 256,
                value: text,
            });
            canvasText.classList.remove('d-none')
            canvasText.innerHTML = text;
            confirmCetakTitle.innerHTML = title;
        }

        function downloadKodeBarang() {
            html2canvas(canvasContainer).then(function(canvas) {
                const downloadLink = document.createElement('a');
                downloadLink.href = canvas.toDataURL('image/png');
                downloadLink.download = canvasText.innerHTML;
                downloadLink.click();
                downloadLink.remove();
            });
        }
    </script>

    <script>
        const confirmDeleteYes = document.getElementById("confirm_delete_yes");

        function confirmSubmit(e, id) {
            const deleteBarangForm = document.getElementById(`delete_barang_form_${id}`);
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

    <script>
        function update() {
            const data = {
                _token: $("[name='_token']").val(),
                id: $("#edit_id").val(),
                kode_barang: $("#edit_kode_barang").val(),
                nama_barang: $("#edit_nama_barang").val(),
                satuan_barang: $("#edit_satuan_barang").val(),
                jumlah_satuan: $("#edit_jumlah_satuan").val(),
                tipe_barang_id: $("#edit_tipe_barang_id").val(),
            }
            $.ajax({
                type: "put",
                url: `{{ url('/admin/barang-gudang/${data.id}') }}`,
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
                kode_barang: $("#kode_barang").val(),
                nama_barang: $("#nama_barang").val(),
                satuan_barang: $("#satuan_barang").val(),
                jumlah_satuan: $("#jumlah_satuan").val(),
                tipe_barang_id: $("#tipe_barang_id").val(),
            }
            $.ajax({
                type: "post",
                url: "{{ url('admin/barang-gudang') }}",
                data: data,
                success: function(data) {
                    window.location.reload();
                },
                error: function() {
                    window.location.reload();
                }
            })
        }

        function tipeBarangReady(tipe_barang_id) {
            $("#edit_tipe_barang_id").empty();
            $("#tipe_barang_id").empty();
            const optDefault = document.createElement('option');
            optDefault.value = "Fara";
            optDefault.innerHTML = "Pilih Tipe Barang";
            $("#tipe_barang_id").append(optDefault);
            $("#tipe_barang_id").find('option[value="Fara"]').prop('disabled', true);
            $.ajax({
                type: 'get',
                url: "{{ url('/tipe-barang') }}",
                success: function(data) {
                    data.forEach((item) => {
                        const opt = document.createElement('option');
                        opt.value = item.id;
                        opt.innerHTML = item.tipe_barang;
                        $("#tipe_barang_id").append(opt);
                        $(tipe_barang_id).append(opt);
                    })
                }
            })
        }

        async function edit(id) {
            const tipeBarang = await tipeBarangReady("#edit_tipe_barang_id");

            await $.ajax({
                type: 'get',
                url: `{{ url('/admin/barang-gudang/${id}') }}`,
                success: function(data) {
                    $("#edit_id").val(data.id);
                    $("#edit_kode_barang").val(data.kode_barang);
                    $("#edit_nama_barang").val(data.nama_barang);
                    $("#edit_satuan_barang").val(data.satuan_barang);
                    $("#edit_jumlah_satuan").val(data.jumlah_satuan);
                    $("#edit_tipe_barang_id").val(data.tipe_barang_id);
                }
            })
        }
    </script>
@endsection
