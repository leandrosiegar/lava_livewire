<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\withFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ShowPosts extends Component
{
    use withFileUploads;
    use WithPagination;

    public $search;
    public $sort = "id";
    public $direction = "desc";
    public $post;
    public $abrir_modal_edit = false;
    public $image, $identificador;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    protected $listeners = [
        'render' => 'render'
    ];

    public function mount() {
        $this->identificador = rand(); // esto es para refrescar el campo img pq por si solo no se refresca
        // $this->image = new Post();
    }

    public function updatingSearch() { // cada cambio q se realice en $search se ejecutará esta función
        $this->resetPage(); // resetea la paginación
    }

    public function render()
    {
        $posts = Post::where("title", "like", "%".$this->search."%")
                ->orwhere("content", "like", "%".$this->search."%")
                ->orderby($this->sort, $this->direction)
                ->paginate(10);

        return view('livewire.show-posts', compact('posts'));
    }

    public function ordenar($sort) {
        if ( $this->sort == $sort) {
            if($this->direction == "desc") {
                $this->direction = "asc";
            }
            else {
                $this->direction = "desc";
            }
        }
        else {
            $this->sort = $sort;
            $this->direction = "asc";
        }
    }

    public function editar(Post $post) {
        $this->post = $post;
        // $this->image = $post->image;
        $this->image = $post->image;
        $this->abrir_modal_edit = true;
    }

    public function actualizar() {
        $this->validate();

        if (strpos($this->image, "posts/") === FALSE)  { // No es la misma img q está en la BD
            Storage::delete([$this->post->image]); // Borramos físicamente la img anterior q hubiera
            $this->post->image = $this->image->store('posts'); // guarda la ruta de la imagen q haya en la propiedad Image en esa carpeta posts
        }


        $this->post->save();

        $this->reset(['abrir_modal_edit', 'image']); // volver a dejarlo como estaban inicialmente
        $this->identificador = rand();

        $this->emit('showMensaje', 'El post se actualizó correctamente');

    }


}
