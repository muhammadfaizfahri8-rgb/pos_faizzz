<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

</body>
</html>