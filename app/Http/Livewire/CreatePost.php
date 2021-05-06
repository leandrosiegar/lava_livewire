<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public $abrir = true;

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
    }
}
