<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public $abrir = true;

    public $title;
    public $content;

    protected $rules = [
        'title' => 'required',
        'content' => 'required'
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

        Post::create(
            [
                'title' => $this->title,
                'content' => $this->content
            ]
        );
        $this->reset(['abrir','title','content']); // volver a dejarlo como estaban inicialmente

        $this->emitTo('show-posts','render'); // emit se encarga de llamar al evento
        $this->emit('showMensaje', 'El post se creó correctamente'); 
        
    }
}
