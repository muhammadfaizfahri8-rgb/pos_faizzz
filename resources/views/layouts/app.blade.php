<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Styling alert agar pasti berwarna hijau lembut dengan tombol close */
        .custom-floating-alert {
            position: fixed !important; /* Memaksa melayang terpisah dari flexbox */
            top: 20px !important;       /* Posisi dari atas layar */
            left: 50% !important;      /* Tepat di tengah horizontal */
            transform: translateX(-50%) !important;
            z-index: 99999 !important; /* Supaya selalu di paling depan */
            min-width: 320px;
            max-width: 90%;
            background-color: #d1e7dd !important;
            color: #0f5132 !important;
            border: 1px solid #badbcc !important;
            border-radius: 12px;
            padding: 12px 40px 12px 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-size: 0.95rem;
            text-align: left;
        }

        .custom-alert-danger {
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
        }

        .close-alert-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
        }

        .close-alert-btn:hover {
            opacity: 1;
        }
    </style>
</head>
<body>

    <!-- Alert Melayang Tepat di Atas Layar -->
    @if(session('success') || session('status') || session('message'))
        <div class="custom-floating-alert">
            <span>{{ session('success') ?? session('status') ?? session('message') }}</span>
            <button type="button" class="close-alert-btn" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif

    @if(session('error'))
        <div class="custom-floating-alert custom-alert-danger">
            <span>{{ session('error') }}</span>
            <button type="button" class="close-alert-btn" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif

    <!-- Content Halaman Utama (Card Login) -->
    @yield('content')

    <!-- Bootstrap 5 JS Bundle CDN (Termasuk PopperJS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>