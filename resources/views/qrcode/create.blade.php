<x-app-layout>
    <x-title-subtitle-box title="Qrcode" subtitle="Créer et modifier le qrcode"/>

    <!--   Alerts   -->
    @if (session('success'))
        <x-alerts.success-alert label="" text="{{ session('success') }}"/>
    @endif
    @foreach ($errors->all() as $error)
        <x-alerts.error-alert label="" text="{{ $error }}"/>
    @endforeach

    @if($qrcode)
        qrcode exist
    @else
        <form method="POST" action="{{route('qrcode.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <x-forms.input-label-box
                labelTitle="Title"
                id="title"
                name="title"
                :value="old('title', $qrcode->title ?? '')"
                type="text"
                :required="true"
                placeholder="Title"
                classes=""/>

            <button type="submit" class="float-right button-default bg-blue-light text-white font-medium">
                Génerate
            </button>
        </form>
    @endif
</x-app-layout>
