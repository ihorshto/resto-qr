<header
    class="lg:ms-[260px] h-16 fixed top-0 inset-x-0 flex justify-between z-40 bg-white border-b border-gray-200">
    <div class="flex justify-between basis-full items-center text-white w-full p-2">
        <!-- Sidebar Toggle -->
        <button type="button"
                class="lg:hidden w-7 h-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-pro-sidebar"
                aria-label="Toggle navigation" data-hs-overlay="#hs-pro-sidebar">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 8L21 12L17 16M3 12H13M3 6H13M3 18H13"/>
            </svg>
        </button>
    </div>
    @include('partials.navigation')
</header>
