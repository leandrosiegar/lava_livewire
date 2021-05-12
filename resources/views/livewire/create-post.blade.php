<div>
    <x-jet-danger-button wire:click="$set('abrir','true')">
    Crear nuevo post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="abrir">
        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">

            <!-- con wire:loading está hide por defecto y solo se muestra cuando se meta en la propia image algún valor -->
            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando</strong>
                <span class="block sm:inline">Espere hasta que la imagen se haya procesado...</span>
            </div>


            @if ($image) <!-- si existe algo en la propiedad $image -->
                <img class="mb-4" src="{{ $image->temporaryUrl() }}">
            @endif

            <div class="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input type="text" class="w-full" wire:model="title" />

                <x-jet-input-error for="title" />


            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea rows=6 class="form-tipo-lsg"  wire:model="content"></textarea>
                <x-jet-input-error for="content" />
            </div>

            <div>
                <input type="file" wire:model="image">
                <x-jet-input-error for="image" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('abrir',false)">
                Cancelar
            </x-jet-secondary-button>

            <!-- con lo del target el botón se deshabilita tanto cuando se da a guardar como cuando estamos cargando algo en la propiedad image -->
            <x-jet-danger-button wire:click="savePost" wire:loading.attr="disabled" wire:target="savePost, image" class="disabled:opacity-25">
                Crear Post
            </x-jet-danger-button>

            <!--- al ser loading lo pone a hide, solo se pondrá a show cuando se ejecute el savePost -->
            <span wire:click="savePost" wire:loading wire:target="savePost">Cargando ...</span>


        </x-slot>

    </x-jet-dialog-modal>
</div>
