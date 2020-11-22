<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class PostLikeComponent extends Component
{
    public $post, $count = 0;

    public function render()
    {
        return view('livewire.posts.post-like-component');
    }

    public function mount($post)
    {
        $this->post = $post;
        $this->count = $post->likeCount;
    }
}
