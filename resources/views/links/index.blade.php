<x-app-layout>
    <div class="flex items-center justify-between">
        <x-title-subtitle-box title="Liste de liens" subtitle="Créer, modifier et suprimer des liens"/>

        <a href="{{ route('links.create') }}" class="button-default bg-blue-light text-white font-medium">
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
                <x-useful-link :link="$link" :editMode="true" />
                <!-- End Card -->
            @endforeach

            <!--   Delete Modal   -->
                <form id="delete-link-form" action="" method="POST">
                @csrf
                @method('DELETE')

                {{--   Confirmation Modal   --}}
                @include('components.modals.confirmation-modal', ['id' => 'hs-delete-link-modal', 'title' => 'Attention!!!', 'subtitle' => 'Voulez-vous vraiment supprimer ce lien ? ', 'slot' => ''])

                <input type="hidden" name="link_id" id="link_id" value="0">
            </form>
        @endif
    </div>


    <script>
        function openDeleteModal(button) {
            const linkId = button.getAttribute('data-link-id');

            // Validate linkId before using
            if (!/^\d+$/.test(linkId)) {
                console.error("Invalid link ID");
                return;

            }

            // Update form action
            const form = document.getElementById('delete-link-form');
            form.action = `/links/${encodeURIComponent(linkId)}`;
        }
    </script>

</x-app-layout>
