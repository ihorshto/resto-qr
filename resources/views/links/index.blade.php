<x-app-layout>
    <div class="flex items-center justify-between">
        <x-title-subtitle-box title="Liens" subtitle="Créer, modifier et suprimer des liens" />

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
        @foreach($links as $link)
            <div>
                <p>{{$link->description}}</p>
            </div>
        @endforeach
    </div>

</x-app-layout>
