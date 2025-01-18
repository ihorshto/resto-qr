<x-app-layout>
    <div>
        @include('links._form', [ 'formAction' => route('links.update', ['link' => $link]), 'formMethod' => 'PUT'])
    </div>
</x-app-layout>
