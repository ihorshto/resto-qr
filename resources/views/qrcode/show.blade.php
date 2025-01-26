<x-app-layout>
    <div>
        <!-- Team Card -->
        <div class="mx-auto my-auto p-4 flex w-3/5 sm:w-2/5 flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <a href="{{route('users.showLinks', auth()->user())}}">
                <img src="{{asset( $qrcode->qr_code_path)}}" alt="QR Code link" class="mb-4 w-full object-cover rounded-xl">
            </a>
            <div class="pt-3 block md:flex items-center gap-x-3 border-t border-gray-200 dark:border-neutral-700">
                <a href="{{route('qrcode.openDocument', $qrcode)}}" target="_blank"  class="md:mb-0 mb-3 w-full py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-[13px] font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg>
                    Télécharger
                </a>
                <a class="w-full flex justify-center items-center gap-x-1.5 py-2 px-2.5 border border-transparent bg-teal-600 font-medium text-[13px] text-white hover:bg-teal-700 rounded-md disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-teal-700 dark:border-transparent dark:bg-teal-500 dark:hover:bg-teal-600 dark:focus:bg-teal-600" href="#">
                    Imprimer
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                </a>
            </div>
        </div>
        <!-- End Team Card -->
    </div>
</x-app-layout>
