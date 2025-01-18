<x-app-layout>
    <div class="flex items-center justify-between">
        <x-title-subtitle-box title="Liste de liens" subtitle="Créer, modifier et suprimer des liens"/>

        <a href="{{ route('links.create') }}" class="button-default bg-teal-500 text-white font-medium">
            Créer
        </a>
    </div>

    <!--   Alerts   -->
    @if (session('success'))
        <x-alerts.success-alert label="" text="{{ session('success') }}"/>
    @endif
    @foreach ($errors->all() as $error)
        <x-alerts.error-alert label="" text="{{ $error }}"/>
    @endforeach

    <div>
        @if(count($links) <= 0)
            <p class="text-sm font-medium text-dark">Aucun lien n'a été trouvé .</p>
        @else
            @foreach($links as $link)
                <!-- Card -->
                <div
                    class="mb-4 relative group bg-white border border-gray-200 -mt-px first:mt-0 first:rounded-t-xl last:rounded-b-xl dark:bg-neutral-900 dark:border-neutral-700">
                    <a class="group p-3 flex items-center gap-x-4 group-first:rounded-t-xl group-last:rounded-b-xl hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                       target="_blank" href="{{$link->link_path}}">
                        <div
                            class="p-3 bg-gray-100 border border-gray-200 rounded-lg dark:bg-neutral-800 dark:border-neutral-700">
                            <img class="w-12 h-8" src="{{asset('storage/' .$link->image_path)}}" alt="Analytics Image">
                        </div>

                        <div class="grow pe-12">
                            <p class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                {{$link->description}}
                            </p>
                            <ul class="mt-1 text-xs text-gray-500 dark:text-neutral-500">
                                <li class="inline-block relative pe-3 last:pe-0 first-of-type:before:hidden before:absolute before:top-1/2 before:-start-2 before:-translate-y-1/2 before:w-px before:h-3 before:bg-gray-300 before:rounded-full dark:before:bg-neutral-600">
                                    {{$link->link_path}}
                                </li>
                            </ul>
                        </div>
                    </a>

                    <!-- More Dropdown -->
                    <div class="absolute top-3 end-3">
                        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                            <button id="hs-pro-fdl1" type="button"
                                    class="sm:p-1.5 sm:ps-3 size-7 sm:w-auto sm:h-auto inline-flex justify-center items-center gap-x-1 rounded-lg border border-gray-200 bg-white text-xs text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <span class="hidden sm:inline-block">Plus</span>
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="1"/>
                                    <circle cx="12" cy="5" r="1"/>
                                    <circle cx="12" cy="19" r="1"/>
                                </svg>
                            </button>

                            <div
                                class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-40 transition-[opacity,margin] duration opacity-0 hidden z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_10px_40px_10px_rgba(0,0,0,0.2)] dark:bg-neutral-800"
                                role="menu" aria-orientation="vertical" aria-labelledby="hs-pro-fdl1">
                                <div class="p-1">
                                    <a href="{{route('links.edit', $link)}}"
                                       class="w-full flex items-center gap-x-3 py-1.5 px-2 rounded-lg text-[13px] font-normal text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                       data-hs-overlay="#hs-pro-detm">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                                            <path d="m15 5 4 4"/>
                                        </svg>
                                        Modifier le fichier
                                    </a>

                                    <div class="my-1 border-t border-gray-200 dark:border-neutral-700"></div>

                                    <!-- Button Delete -->
                                    <form action="{{route('links.destroy', $link)}}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="w-full flex items-center gap-x-3 py-1.5 px-2 rounded-lg text-[13px] font-normal text-red-600 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-red-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                                data-hs-overlay="#hs-pro-chhdl">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18"/>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                                <line x1="10" x2="10" y1="11" y2="17"/>
                                                <line x1="14" x2="14" y1="11" y2="17"/>
                                            </svg>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End More Dropdown -->
                </div>
                <!-- End Card -->
            @endforeach
        @endif
    </div>

</x-app-layout>
