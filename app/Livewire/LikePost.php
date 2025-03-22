<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;

    public $isLiked;
    public $likes;

    // mount es como un constructor en php y isLiked verificara si el usuario le ha dado like o no a un post
    // Solo se ejecuta cuando es instanciado por lo que queda valor fijo
    public function mount($post) 
    {
        $this->isLiked = $post->checkLike(auth()->user());
        // Contar likes
        $this->likes = $post->likes->count();
    }

    // Interaccion del usuario
    public function like()
    {
        if ($this->post->checkLike(auth()->user() )) {
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            // en base a fill="{{ $isLiked ? "red" : "white" }}"
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            // en base a fill="{{ $isLiked ? "red" : "white" }}"
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
