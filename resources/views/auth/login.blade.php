<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIP-ASET Disdik Kota Palangka Raya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Keyframes: Slide In Sisi Kiri */
        @keyframes slideInLeftSlow {
            0% {
                opacity: 0;
                transform: translateX(-35px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Keyframes: Fade In + Scale Up Sisi Kanan */
        @keyframes fadeInScaleSlow {
            0% {
                opacity: 0;
                transform: scale(0.92);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Class Animasi dengan Initial State Blank (opacity: 0) & Durasi Terasa */
        .animate-slide-left-slow {
            opacity: 0;
            animation: slideInLeftSlow 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
        }

        .animate-fade-scale-slow {
            opacity: 0;
            animation: fadeInScaleSlow 1.3s cubic-bezier(0.16, 1, 0.3, 1) 0.5s forwards;
        }
    </style>
</head>
<body class="h-full bg-slate-900 text-slate-800 antialiased selection:bg-slate-200 overflow-hidden">
    <!-- Inject Toast Floating Container -->
    @include('components.toast')

    <div class="min-h-screen flex bg-slate-900">
        <!-- SISI KIRI (FORM PANEL - SLIDE IN DENGAN DELAY 0.2s) -->
        <div class="w-full lg:w-3/12 bg-white flex flex-col justify-between p-6 sm:p-8 z-10 border-r border-slate-200 animate-slide-left-slow">
            <!-- Main Form -->
            <div class="my-auto py-4 w-full space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang</h2>
                    <p class="text-sm text-slate-500 mt-1.5 leading-relaxed">Masukkan NIP dan kata sandi untuk masuk ke sistem.</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4 w-full">
                    @csrf
                    <!-- Input NIP / Email -->
                    <div class="w-full">
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">NIP / Email Official</label>
                        <div class="relative w-full">
                            <input type="text" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="19880312... atau admin@palangkaraya.go.id"
                                class="w-full pl-9 pr-3 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:border-slate-400 focus:outline-none transition-all placeholder:text-slate-400 text-slate-900 font-medium shadow-sm">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div class="w-full">
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="#" class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold hover:underline">Lupa sandi?</a>
                            @endif
                        </div>
                        <div class="relative w-full">
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full pl-9 pr-3 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:border-slate-400 focus:outline-none transition-all placeholder:text-slate-400 text-slate-900 font-medium shadow-sm">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Remember Me Option -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500">
                            <span class="text-xs text-slate-600 font-medium">Ingat sesi saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow transition-all flex items-center justify-center gap-2 group mt-2">
                        <span>Masuk ke Dashboard</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-white group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Footer Kiri -->
            <div class="text-xs text-slate-400 text-center lg:text-left font-medium">
                &copy; {{ date('Y') }} Dinas Pendidikan Kota Palangka Raya.
            </div>
        </div>

        <!-- SISI KANAN (FRAME & LOGO - FADE/SCALE DENGAN DELAY 0.5s) -->
        <div class="hidden lg:flex lg:w-9/12 bg-slate-900 items-center justify-center p-12 relative overflow-hidden">
            <!-- Background Radial Glow (Sintaks Tailwind Direvisi Sesuai Linter) -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,var(--tw-gradient-stops))] from-slate-800/60 via-slate-900 to-slate-900 pointer-events-none"></div>

            <!-- Content Center -->
            <div class="flex flex-col items-center text-center space-y-6 max-w-2xl z-10 animate-fade-scale-slow">
                <!-- Frame Logo Pemko Bulat -->
                <div class="w-48 h-48 sm:w-56 sm:h-56 rounded-full bg-slate-800/40 border-2 border-amber-400/80 p-4 backdrop-blur-md shadow-2xl flex items-center justify-center transition-all duration-500 hover:scale-105 hover:border-amber-300 hover:shadow-[0_0_35px_rgba(251,191,36,0.3)]">
                    <img src="{{ asset('img/logo-pemko.png') }}" alt="Logo Pemko Palangka Raya"
                        class="w-full h-full object-contain filter drop-shadow-lg"
                        onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Lambang_Kota_Palangkaraya.png/250px-Lambang_Kota_Palangkaraya.png';">
                </div>
                <!-- Text Identity -->
                <div class="space-y-2 pt-2">
                    <h2 class="text-2xl xl:text-3xl font-extrabold text-white tracking-wide uppercase whitespace-nowrap">
                        Pemerintah Kota Palangka Raya
                    </h2>
                    <p class="text-base sm:text-lg font-bold text-emerald-400 tracking-wider uppercase">
                        Dinas Pendidikan
                    </p>
                </div>
                <!-- Divider & Description -->
                <div class="w-20 h-0.5 bg-slate-800 my-2"></div>
                <p class="text-sm sm:text-base text-slate-400 leading-relaxed max-w-lg">
                    Sistem Informasi Pengelolaan & Pemetaan Aset Inventaris Sekolah Terpadu (SIP-ASET)
                </p>
            </div>
        </div>
    </div>
</body>
</html>