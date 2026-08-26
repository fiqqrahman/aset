<!-- Toast Notification Floating Container (Top Right) -->
<div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none">
    
    <!-- 1. Toast Success (session('status') / session('success')) -->
    @if (session('status') || session('success'))
        <div class="toast-item pointer-events-auto flex items-start gap-3 p-3.5 bg-slate-900 border border-emerald-500/30 text-white rounded-xl shadow-2xl backdrop-blur-md transition-all duration-300 transform translate-x-10 opacity-0">
            <div class="p-1.5 bg-emerald-500/10 text-emerald-400 rounded-lg shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="flex-1 text-xs">
                <p class="font-bold text-emerald-400 uppercase tracking-wider text-[10px]">Sukses</p>
                <p class="text-slate-200 mt-0.5 font-medium leading-relaxed">{{ session('status') ?? session('success') }}</p>
            </div>
            <button onclick="dismissToast(this.parentElement)" class="text-slate-400 hover:text-slate-200 transition-colors p-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- 2. Toast Error / Validation Fail ($errors->any() / session('error')) -->
    @if (session('error') || $errors->any())
        <div class="toast-item pointer-events-auto flex items-start gap-3 p-3.5 bg-slate-900 border border-rose-500/30 text-white rounded-xl shadow-2xl backdrop-blur-md transition-all duration-300 transform translate-x-10 opacity-0">
            <div class="p-1.5 bg-rose-500/10 text-rose-400 rounded-lg shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="flex-1 text-xs">
                <p class="font-bold text-rose-400 uppercase tracking-wider text-[10px]">Pemberitahuan Gagal</p>
                @if (session('error'))
                    <p class="text-slate-200 mt-0.5 font-medium leading-relaxed">{{ session('error') }}</p>
                @else
                    <ul class="list-disc list-inside text-slate-200 mt-0.5 space-y-0.5 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <button onclick="dismissToast(this.parentElement)" class="text-slate-400 hover:text-slate-200 transition-colors p-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

</div>

<!-- Auto-Dismiss Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toasts = document.querySelectorAll('.toast-item');
        toasts.forEach((toast, index) => {
            // Animate Slide-In
            setTimeout(() => {
                toast.classList.remove('translate-x-10', 'opacity-0');
            }, 100 * (index + 1));

            // Auto Dismiss dalam 4.5 Detik
            setTimeout(() => {
                dismissToast(toast);
            }, 4500 + (index * 500));
        });
    });

    function dismissToast(element) {
        if (!element) return;
        element.classList.add('translate-x-10', 'opacity-0');
        setTimeout(() => {
            element.remove();
        }, 300);
    }
</script>