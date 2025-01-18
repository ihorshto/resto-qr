<x-app-layout>
    <div>
        @include('links._form', ['formAction' => route('links.store'), 'formMethod' => 'POST'])
    </div>
</x-app-layout>
