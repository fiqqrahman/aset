<header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-10">
    <div class="flex items-center gap-4 w-1/3">
        <div class="relative w-full">
            <input type="text" placeholder="Cari Kode Barang, Nama Aset, atau ID Sekolah..."
                class="w-full pl-9 pr-4 py-1.5 text-xs bg-slate-100 border border-transparent rounded-md focus:bg-white focus:border-slate-300 focus:outline-none transition-all">
            <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <select
            class="text-xs border border-slate-200 rounded-md px-3 py-1.5 bg-white text-slate-600 focus:outline-none font-medium">
            <option>TA 2026 (Aktif)</option>
            <option>TA 2025</option>
        </select>
        <div class="h-4 w-px bg-slate-200"></div>
        <button
            class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium rounded-md transition-colors flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Input Aset
        </button>
    </div>
</header>
