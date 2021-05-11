<div>
    <x-jet-danger-button wire:click="$set('abrir','true')">
    Crear nuevo post 
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="abrir">
        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">
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

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('abrir',false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="savePost">
                Crear Post
            </x-jet-danger-button>


        </x-slot>

    </x-jet-dialog-modal>
</div>
