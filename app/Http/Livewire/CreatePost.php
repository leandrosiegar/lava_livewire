<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\withFileUploads;

class CreatePost extends Component
{
    use withFileUploads;

    public $abrir = false;

    public $title;
    public $content;
    public $image;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048'
    ];

    public function updated($prop_name) { // a updated se llama siempre q se modifica cualquiera de las propiedades definidas
       //  $this->validateOnly($prop_name);

    }

    public function render()
    {
        return view('livewire.create-post');
    }

    public function savePost() {

        $this->validate();

        $imageFinal = $this->image->store('posts'); // guarda la ruta de la imagen q haya en la propiedad Image en esa carpeta posts

        Post::create(
            [
                'title' => $this->title,
                'content' => $this->content,
                'image' => $imageFinal

            ]
        );
        $this->reset(['abrir','title','content','image']); // volver a dejarlo como estaban inicialmente

        $this->emitTo('show-posts','render'); // emit se encarga de llamar al evento
        $this->emit('showMensaje', 'El post se creó correctamente');

    }
}
