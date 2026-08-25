<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem - SIP-ASET Disdik Kota Palangka Raya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">
    <div class="min-h-screen flex">
        
        <!-- Left Hero Section: Branding Dinas Pendidikan -->
        <div class="hidden lg:flex lg:w-1/2 bg-slate-900 border-r border-slate-800 p-12 flex-col justify-between relative overflow-hidden">
            <!-- Background Decorative Glows -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Top Header Logos -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center text-white font-extrabold text-sm shadow-lg shadow-emerald-600/20">
                    PR
                </div>
                <div>
                    <h1 class="text-sm font-bold text-white uppercase tracking-wider">SIP-ASET DISDIK</h1>
                    <p class="text-xs text-slate-400">Kota Palangka Raya</p>
                </div>
            </div>

            <!-- Hero Message -->
            <div class="relative z-10 my-auto max-w-lg space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Sistem Informasi Inventaris BMD
                </span>
                <h2 class="text-3xl font-extrabold text-white tracking-tight leading-snug">
                    Tata Kelola & Monitoring Geospasial Aset Pendidikan Terpadu
                </h2>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Integrasi data real-time sarana & prasarana unit sekolah jenjang TK, SD, hingga SMP se-Kota Palangka Raya.
                </p>
            </div>

            <!-- Footer Badge -->
            <div class="relative z-10 pt-6 border-t border-slate-800 flex items-center justify-between text-xs text-slate-500">
                <span>&copy; {{ date('Y') }} Disdik Palangka Raya</span>
                <span class="font-mono text-emerald-400/80">v2.4.0 Live Engine</span>
            </div>
        </div>

        <!-- Right Form Section: Authentication Panel -->
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-sm space-y-6">
                
                <!-- Form Title Header -->
                <div>
                    <!-- Mobile Logo Indicator -->
                    <div class="lg:hidden flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold text-xs">
                            PR
                        </div>
                        <span class="text-xs font-bold text-slate-900 tracking-wider">SIP-ASET DISDIK</span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 tracking-tight">Masuk ke Akun Admin</h3>
                    <p class="text-xs text-slate-500 mt-1">Masukkan NIP / Email dinas dan kata sandi antum untuk melanjutkan.</p>
                </div>

                <!-- Session Flash Messages (Errors / Status) -->
                @if (session('status'))
                    <div class="p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-xs text-emerald-700 font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-3 rounded-lg bg-rose-50 border border-rose-200 text-xs text-rose-700 space-y-1">
                        <p class="font-bold">Gagal Autentikasi:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- NIP / Email Input -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">NIP / Email Official</label>
                        <div class="relative">
                            <input type="text" id="email" name="email" value="{{ old('email') }}" required autofocus
                                placeholder="19880312... atau user@palangkaraya.go.id"
                                class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:border-slate-400 focus:outline-none transition-all placeholder:text-slate-400 text-slate-900 font-medium">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-xs font-semibold text-slate-700">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="#" class="text-[11px] text-emerald-600 hover:text-emerald-700 font-semibold hover:underline">
                                    Lupa sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                placeholder="••••••••"
                                class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:border-slate-400 focus:outline-none transition-all placeholder:text-slate-400 text-slate-900 font-medium">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Remember Me Option -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-3.5 h-3.5 text-emerald-600 rounded border-slate-300 focus:ring-emerald-500">
                            <span class="text-xs text-slate-600">Ingat sesi saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg shadow-sm hover:shadow transition-all flex items-center justify-center gap-2 group">
                        <span>Masuk ke System Dashboard</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-white group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>

                <!-- Help Desk Context Footer -->
                <div class="pt-4 border-t border-slate-100 text-center">
                    <p class="text-[11px] text-slate-400">
                        Mengalami kendala hak akses NIP/Akun? <br>
                        Hubungi <a href="#" class="text-slate-700 font-semibold hover:underline">Tim IT Disdik Palangka Raya</a>.
                    </p>
                </div>

            </div>
        </div>

    </div>
</body>
</html>