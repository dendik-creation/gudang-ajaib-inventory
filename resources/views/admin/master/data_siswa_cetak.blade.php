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
        <div class="row row-cols-6" id="qrcode_container">
            {{--  --}}
            @foreach ($siswas as $i => $item)
                <div class="d-flex my-3 justify-content-center align-items-center flex-column gap-2" id="canvas_container"
                    {{-- style="width : 8.5cm ; height: 5.4cm;" --}}
                    >
                    <canvas id="qrcode-{{ $i }}" class=""></canvas>
                    <code class="fs-3">{{ $item->nis }}</code>
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
