<div>




    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <x-tablelsg>
            <div class="px-6 py-4 flex items-center">
               <!-- <input type="text" wire:model="search"> -->
               <!-- en vez de usar un input normal usamos los de jetstream más bonitos -->
               <x-jet-input class="flex-1 mr-4" placeholder="buscar" type="text" wire:model="search" />
                @livewire('create-post')
            </div>

            @if ($posts->count())

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
                    @foreach ($posts as $post)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $post->id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $post->title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $post->content }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @livewire('edit-post',['post' => $post], key($post->id))
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @else
                <div class="px-6 py-4">
                    No existe ningún registro con esos parámetros de búsqueda
                </div>
            @endif
        </x-tablelsg>


    </div>

</div>
