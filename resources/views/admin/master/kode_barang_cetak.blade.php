<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    {{-- CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

</head>

<body class="bg-white">
                {{-- QrCode --}}
                @if ($kode == 'qrcode')
                <div class="row row-cols-5" id="qrcode_container">
                    {{--  --}}
                    @foreach ($kode_barangs as $i => $item)
                        <div class="col d-flex align-items-center flex-column">
                            <canvas id="qrcode-{{ $i }}"></canvas>
                            <code class="fs-5">{{ $item->kode_barang }}</code>
                            <script>
                                generateQrCode(@json($item->kode_barang), @json($i))

                                function generateQrCode(text, i) {
                                    new QRious({
                                        element: document.getElementById(`qrcode-${i}`),
                                        background: '#ffffff',
                                        backgroundAlpha: 1,
                                        foreground: '#000',
                                        foregroundAlpha: 1,
                                        level: 'H',
                                        padding: 10,
                                        size: 150,
                                        value: text,
                                    });
                                }
                            </script>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Barcode --}}
            @if ($kode == 'barcode')
                <div class="row row-cols-3" id="barcode_container">
                    {{--  --}}
                    @foreach ($kode_barangs as $i => $item)
                        <div class="col d-flex align-items-center flex-column">
                            <canvas id="barcode-{{ $i }}"></canvas>
                            <script>
                                generateBarcode(@json($item->kode_barang), @json($i))

                                function generateBarcode(text, i) {
                                    JsBarcode(document.getElementById(`barcode-${i}`), text, {
                                        format: 'CODE128',
                                        displayValue: true,
                                        width: 1.5,
                                        height: 70,
                                    });
                                }
                            </script>
                        </div>
                    @endforeach
                </div>
            @endif

    <script>
        window.onload = () => window.print()
    </script>
</body>

</html>
