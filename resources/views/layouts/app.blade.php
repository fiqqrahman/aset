<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Inventaris Aset - Disdik Kota Palangka Raya')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            600: '#16a34a',
                            700: '#15803d',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        #map {
            height: 100%;
            width: 100%;
            border-radius: 0.5rem;
            z-index: 1;
        }
    </style>
    @stack('styles')
</head>

<body class="h-full text-slate-800 antialiased selection:bg-slate-200 overflow-hidden">

    @include('components.toast')

    <!-- h-screen & overflow-hidden mengunci layar agar tidak scroll sebadan-badan -->
    <div class="h-screen flex overflow-hidden">

        <!-- Sidebar Fixed Layout -->
        @include('components.sidebar')

        <!-- Main Content Area (Berdiri Sendiri & Scrollable) -->
        <div class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto">
            @include('components.navbar')
            <main class="p-6 space-y-6 flex-1">
                @yield('content')
            </main>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateClock() {
                const now = new Date();
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];
                const dayName = days[now.getDay()];
                const date = now.getDate();
                const monthName = months[now.getMonth()];
                const year = now.getFullYear();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const clockEl = document.getElementById('realtime-clock');
                if (clockEl) {
                    clockEl.textContent = `${dayName}, ${date} ${monthName} ${year} pukul ${hours}.${minutes} WIB`;
                }
            }
            updateClock();
            setInterval(updateClock, 30000);
        });
    </script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('scripts')
</body>

</html>
