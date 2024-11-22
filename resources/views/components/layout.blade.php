<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/bootstrap-5.3.3/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <!-- Tambahkan ini di bagian <head> di Blade template Anda -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
</head>

<body class="bg-light">

    <x-navbar/>

{{ $slot }}

<!-- Bootstrap JS Bundle (popper.js included) -->
<script src="{{ asset('/bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d",
            allowInput: true
        });
    });
</script>

<!-- Tambahkan ini di bagian <body> di Blade template Anda, setelah semua script lain -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</body>

</html>