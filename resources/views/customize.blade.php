<x-app-layout>
    <x-title-subtitle-box title="Personnaliser la page de liens"
                          subtitle="Changer le logo, l'image d'arrière-plan ou la couleur d'arrière-plan"/>

    <form method="POST" action="{{route('users.updateStyles')}}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- Choose Background Type -->
        <div class="mb-6">
            <label class="block font-semibold text-sm mb-1">Utiliser :</label>
            <div class="grid sm:grid-cols-2 gap-2">
                <label for="hs-radio-in-form" class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    <input type="radio" name="background_type" value="{{\App\Models\User::BACKGROUND_TYPE_COLOR}}" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-in-form" {{$user->background_type == \App\Models\User::BACKGROUND_TYPE_COLOR ? 'checked' : '' }}>
                    <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">La couleur d'arrière-plan</span>
                </label>

                <label for="hs-radio-checked-in-form" class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    <input type="radio" name="background_type" value="{{\App\Models\User::BACKGROUND_TYPE_IMAGE}}" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-checked-in-form" {{$user->background_type == \App\Models\User::BACKGROUND_TYPE_IMAGE ? 'checked' : '' }}>
                    <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">L'image d'arrière-plan</span>
                </label>
            </div>
        </div>

        <div class="mb-4 sm:mb-6">
            <label for="hs-file-upload" class="block font-semibold text-sm mb-1">La couleur d'arrière-plan</label>
            <input
                type="color"
                name="background_color"
                class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700"
                id="hs-color-input" value="{{old('background_color', $user->background_color)}}" title="Choose your color">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6 gap-0">
            <div class="mb-4 sm:mb-6">
                <label for="hs-file-upload" class="block font-semibold text-sm mb-1">L'image d'arrière-plan</label>
                <x-forms.file-upload
                    id="hs-file-upload-background-image"
                    url="{{ route('links.uploadImage') }}"
                    maxFiles="1" maxFilesize="4" singleton="true" fileName="bg_image_name"
                    acceptedFiles="image/jpeg, image/jpg, image/png, image/gif, image/svg+xml, image/webp"
                    fileUploadName="background_image_name">
                </x-forms.file-upload>
            </div>
            <div class="mb-4 sm:mb-6">
                <label for="hs-file-upload" class="block font-semibold text-sm mb-1">Le logo</label>
                <x-forms.file-upload
                    id="hs-file-upload-logo"
                    url="{{ route('links.uploadImage') }}"
                    maxFiles="1" maxFilesize="4" singleton="true" fileName="bg_image_name"
                    acceptedFiles="image/jpeg, image/jpg, image/png, image/gif, image/svg+xml, image/webp"
                    fileUploadName="logo_name">
                </x-forms.file-upload>
            </div>
        </div>

        <button type="submit" class="float-right button-default bg-blue-light text-white font-medium">
            Sauvegarder
        </button>
    </form>
</x-app-layout>
