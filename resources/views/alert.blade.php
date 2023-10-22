    <link rel="stylesheet" href="/assets/extensions/toastify-js/src/toastify.css">
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
    {{-- Success --}}
    @if (Session::has('success'))
        <script>
            toastResult("bottom", "right", "{{ Session::get('success') }}", "success")
        </script>
    @endif

    {{-- Failed/Errpr --}}
    @if (Session::has('failed'))
        <script>
            toastResult("bottom", "right", "{{ Session::get('failed') }}", "failed")
        </script>
    @endif


    {{-- Invalid Add New User --}}
    @if ($errors->any())
        @foreach ($errors->all() as $item)
            <script>
                toastResult("bottom", "right", @json($item), "failed");
            </script>
        @endforeach

    @endif
