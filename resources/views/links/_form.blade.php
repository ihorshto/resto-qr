<form method="POST" action="{{$formAction}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($formMethod === 'PUT')
        @method('PUT')
    @else
        @method('POST')
    @endif

    <x-title-subtitle-box title="{{$formMethod == 'POST' ? 'Créer' : 'Modifier'}} un lien" subtitle="Remplir le description et logo"/>

    <!--   Alerts   -->
    @if (session('success'))
        <x-alerts.success-alert label="" text="{{ session('success') }}"/>
    @endif
    @foreach ($errors->all() as $error)
        <x-alerts.error-alert label="" text="{{ $error }}"/>
    @endforeach

    <x-forms.input-label-box
        labelTitle="Description"
        id="description"
        name="description"
        :value="old('description', $link->description ?? '')"
        type="text"
        placeholder="Description"
        classes=""/>

    <x-forms.input-label-box
        labelTitle="Lien"
        id="link_path"
        name="link_path"
        :value="old('link', $link->link_path ?? '')"
        type="text"
        placeholder="Lien"
        classes=""/>

    <div class="mb-4 sm:mb-6">
        <label for="hs-file-upload" class="block font-semibold text-sm mb-1">Fichier</label>
        <x-forms.file-upload
            id="hs-file-upload"
            url="{{ route('links.uploadImage') }}"
            maxFiles="1" maxFilesize="4" singleton="true" fileName="bg_image_name"
            acceptedFiles="image/jpeg, image/jpg, image/png, image/gif, image/svg+xml, image/webp">
        </x-forms.file-upload>
    </div>

    <!--   Image is required while link creation   -->
    <input type="hidden"
           name="is_create_link"
           id="is_create_link"
           value="{{$formMethod == 'POST' ? '1' : '0'}}">

    <button type="submit" class="float-right button-default bg-teal-500 text-white font-medium">
        {{$formMethod == 'POST' ? 'Créer' : 'Modifier'}}
    </button>
</form>
