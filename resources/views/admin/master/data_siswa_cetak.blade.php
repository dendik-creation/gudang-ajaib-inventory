<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    {{-- CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

</head>

<body class="bg-white">
        <div class="row row-cols-2" id="qrcode_container">
            {{--  --}}
            @foreach ($siswas as $i => $item)
                <div class="d-flex my-3 justify-content-center align-items-center gap-2 bg-light-primary" id="canvas_container"
                    {{-- style="width : 8.5cm ; height: 5.4cm;" --}}
                    >
                    <canvas id="qrcode-{{ $i }}" class=""></canvas>

                    <div class="d-flex justify-content-start my-3 align-items-start flex-column pe-3">
                        <span class="fw-bold mb-3">Kartu Peminjaman Barang TJKT</span>
                        <div class="d-flex justify-content-start align-items-start gap-2 mb-2">
                            <i class="me-2 bi bi-person-rolodex mb-2"></i>
                            <small id="siswa_name">{{ $item->nama }}</small>
                        </div>
                        <div class="d-flex justify-content-start align-items-start gap-2 mb-2">
                            <i class="me-2 bi bi-person-workspace mb-2"></i>
                            <small id="siswa_kelas">{{ $item->kelas->kelas }}</small>
                        </div>
                        <div class="d-flex justify-content-start align-items-start gap-2 mb-2">
                            <i class="me-2 bi bi-person-vcard mb-2"></i>
                            <small id="siswa_nis_nisn">{{ $item->nis }} / {{ $item->nisn }}</small>
                        </div>
                        <div class="d-flex justify-content-start align-items-start gap-2 mb-2">
                            <i class="me-2 bi mb-2 {{ $item->gender == 'P' ? 'bi-gender-female' : 'bi-gender-male' }}"
                                id="gender_card_icon"></i>
                            <small id="siswa_gender">{{ $item->gender }}</small>
                        </div>
                    </div>
                    <script>
                        generateQrCode(@json($item->nis), @json($i))

                        function generateQrCode(text, i) {
                            new QRious({
                                element: document.getElementById(`qrcode-${i}`),
                                background: '#ffffff',
                                backgroundAlpha: 0,
                                foreground: '#1c1c1c',
                                foregroundAlpha: 1,
                                level: 'H',
                                padding: 10,
                                size: 128,
                                value: text,
                            });
                        }
                    </script>
                </div>
            @endforeach
        </div>


    <script>
        window.onload = () => window.print()
    </script>
</body>

</html>
