<x-app-layout>
    <x-title-subtitle-box title="Personnaliser la page de liens" subtitle="Changer le logo, l'image d'arrière-plan ou la couleur d'arrière-plan"/>

    <form method="POST" action="{{route('users.updateStyles')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-4 sm:mb-6">
        <label for="hs-file-upload" class="block font-semibold text-sm mb-1">La couleur d'arrière-plan</label>
        <input type="color" name="color" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" id="hs-color-input" value="#2563eb" title="Choose your color">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6 gap-0">
            <div class="mb-4 sm:mb-6">
                <label for="hs-file-upload" class="block font-semibold text-sm mb-1">Le logo</label>
                <x-forms.file-upload
                    id="hs-file-upload-logo"
                    url="{{ route('links.uploadImage') }}"
                    maxFiles="1" maxFilesize="4" singleton="true" fileName="bg_image_name"
                    acceptedFiles="image/jpeg, image/jpg, image/png, image/gif, image/svg+xml, image/webp">
                </x-forms.file-upload>
            </div>
            <div class="mb-4 sm:mb-6">
                <label for="hs-file-upload" class="block font-semibold text-sm mb-1">L'image d'arrière-plan</label>
                <x-forms.file-upload
                    id="hs-file-upload-background-image"
                    url="{{ route('links.uploadImage') }}"
                    maxFiles="1" maxFilesize="4" singleton="true" fileName="bg_image_name"
                    acceptedFiles="image/jpeg, image/jpg, image/png, image/gif, image/svg+xml, image/webp">
                </x-forms.file-upload>
            </div>
        </div>

        <button type="submit" class="float-right button-default bg-blue-light text-white font-medium">
            Sauvegarder
        </button>
    </form>
    </x-app-layout>
