<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public $abrir = false;

    public $title;
    public $content;

    public function render()
    {
        return view('livewire.create-post');
    }

    public function savePost() {
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
