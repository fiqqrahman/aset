<header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-10">
    <!-- Left Section: Global Search Bar -->
    <div class="flex items-center gap-4 w-1/3">
        <div class="relative w-full">
            <input type="text" placeholder="Cari Kode Barang, Nama Aset, NIP, atau ID Sekolah..."
                class="w-full pl-9 pr-4 py-1.5 text-xs bg-slate-100 border border-transparent rounded-md focus:bg-white focus:border-slate-300 focus:outline-none transition-all">
            <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <!-- Right Section: System Context & Actions -->
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-1.5">
            <label for="ta_selector"
                class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider hidden sm:inline">TA:</label>
            <select id="ta_selector"
                class="text-xs border border-slate-200 rounded-md px-2.5 py-1.5 bg-white text-slate-700 font-semibold focus:outline-none focus:border-emerald-500 cursor-pointer">
                <option value="2026" selected>2026 (Aktif)</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
            </select>
        </div>

        <div
            class="hidden md:flex items-center gap-2 text-xs text-slate-500 bg-slate-50 px-3 py-1.5 rounded-md border border-slate-200/60 ml-1">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span id="realtime-clock" class="font-medium text-slate-700">
                {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }} pukul
                {{ \Carbon\Carbon::now()->format('H.i') }} WIB
            </span>
        </div>

        <a href="#"
            class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-md transition-colors"
            title="Bantuan & Panduan Sistem">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>

        <button type="button"
            class="relative p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-md transition-colors"
            title="Notifikasi Sistem">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
        </button>

        <div class="h-4 w-px bg-slate-200"></div>

        <!-- Tombol Logout Secure (POST Form) -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-md transition-colors flex items-center gap-1.5 text-xs font-medium"
                title="Keluar dari Sistem">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="hidden xl:inline">Keluar</span>
            </button>
        </form>
    </div>
</header>
