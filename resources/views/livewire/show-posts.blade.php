<div wire:init="cargarPost"> <!-- esto es de cargarPost es para q se ejecute primero lo q menos peso y una vez cargado ya llama a esta función -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <x-tablelsg>
            <div class="px-6 py-4 flex items-center">
               <!-- <input type="text" wire:model="search"> -->
               <div class="flex item-center">
                   <span>Mostrar</span>
                   <select wire:model="cant" class="mx-2 form-control">
                       <option value="10">10</option>
                       <option value="25">25</option>
                       <option value="50">50</option>
                       <option value="100">100</option>
                   </select>
                   <span>Entradas</span>

               </div>
               <!-- en vez de usar un input normal usamos los de jetstream más bonitos -->
               <x-jet-input class="flex-1 mx-4" placeholder="buscar" type="text" wire:model="search" />
                @livewire('create-post')
            </div>

            @if (count($posts))

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                    <th scope="col" wire:click="ordenar('id')" class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                        @if ($sort == "id")
                            @if ($direction == "asc")
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" wire:click="ordenar('title')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Title
                        @if ($sort == "title")
                            @if ($direction == "asc")
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" wire:click="ordenar('content')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Content
                        @if ($sort == "content")
                            @if ($direction == "asc")
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($posts as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $item->id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $item->title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $item->content }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                               {{-- @livewire('edit-post',['post' => $post], key($post->id)) --}}
                               <a class="boton botonVerde" wire:click="editar({{$item}})">
                                    <i class="fas fa-edit"></i>
                                </a>

                            </td>
                        </tr>



                    @endforeach
                </tbody>
            </table>

            @if ($posts->hasPages()) <!-- si al menos tiene dos pages q muestre paginación -->
                <div class="px-6 py-3">
                    {{ $posts->links() }}
                </div>
            @endif

            <!-- crear el modal para abrir -->
            <x-jet-dialog-modal wire:model="abrir_modal_edit">
                <x-slot name='title'>
                    Editar el post
                </x-slot>
                <x-slot name='content'>
                    <!-- con wire:loading está hide por defecto y solo se muestra cuando se meta en la propia image algún valor -->
                    <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Imagen cargando</strong>
                        <span class="block sm:inline">Espere hasta que la imagen se haya procesado...</span>
                    </div>
                        <?php
                        if (strpos($image, "posts/") !== FALSE)  { // img de la BD
                           $ruta = Storage::url($image);
                           $ruta = str_replace("lava_livewire.test", "lava_livewire", $ruta)
                            ?>
                            <img src="{{ $ruta }}">
                            <?php
                        }
                        if (strpos($image, "Temp") !== FALSE)  { // img temp del FILE ?>
                            <img class="mb-4" src="{{ $image->temporaryUrl() }}">
                            <?php
                        }


                        ?>
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
                        <x-jet-input-error for="image" id="{{$identificador}}" /> <!-- lo del identifiador es para q se refresque -->
                    </div>
                </x-slot>

                <x-slot name='footer'>
                    <x-jet-secondary-button wire:click="$set('abrir_modal_edit', false)">
                        Cancelar
                    </x-jet-secondary-button>

                    <x-jet-danger-button wire:click="actualizar" wire:loading.attr="disabled" class="disabled:opacity-25">
                        Actualizar
                    </x-jet-secondary-button>
                </x-slot>
            </x-jet-dialog-modal>

            @else
                <div class="px-6 py-4">
                    No existe ningún registro con esos parámetros de búsqueda
                </div>
            @endif



        </x-tablelsg>


    </div>



</div>
