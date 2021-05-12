<div>
    <a class="boton botonVerde" wire:click="$set('abrir', true)">
        <i class="fas fa-edit"></i>
    </a>


    <x-jet-dialog-modal wire:model="abrir">
        <x-slot name='title'>
            Editar el post
        </x-slot>

        <x-slot name='content'>
            <!-- con wire:loading está hide por defecto y solo se muestra cuando se meta en la propia image algún valor -->
            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando</strong>
                <span class="block sm:inline">Espere hasta que la imagen se haya procesado...</span>
            </div>
            @if ($image) <!-- si existe algo en la propiedad $image -->
                <img class="mb-4" src="{{ $image->temporaryUrl() }}">
            @else <!-- por defecto nada más entrar q muestre la q está guardada en la BD -->
                <?php
                    $ruta = Storage::url($post->image);
                    $ruta = str_replace("lava_livewire.test", "lava_livewire", $ruta)
                ?>
                <img src="{{ $ruta }}">
            @endif


            <div class="mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input wire:model="post.title" type="text" class="w-full" />
            </div>

            <div>
                <x-jet-label value="Contenido del post" />
                <textarea wire:model="post.content" rows="6" class="form-control w-full"></textarea>
            </div>

            <div>
                <input type="file" wire:model="image">
                <x-jet-input-error for="image" />
            </div>

        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('abrir', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="actualizar" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-jet-secondary-button>



        </x-slot>

    </x-jet-dialog-modal>

</div>
