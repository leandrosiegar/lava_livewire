<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\withFileUploads;

use Illuminate\Support\Facades\Storage;

class xxxEditPost extends Component
{
    use withFileUploads;

    public $post;
    public $abrir = false;
    public $image;


    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    public function xxxmount(Post $post) {
        $this->post = $post;
    }

    public function XXxactualizar() {
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->post->image]); // Borramos físicamente la img anterior q hubiera
            $this->post->image = $this->image->store('posts'); // guarda la ruta de la imagen q haya en la propiedad Image en esa carpeta posts

        }

        $this->post->save();

        $this->reset(['abrir', 'image']); // volver a dejarlo como estaban inicialmente
        $this->emitTo('show-posts','render'); // emit se encarga de llamar al evento
        $this->emit('showMensaje', 'El post se actualizó correctamente');

    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
