<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class PostLikeComponent extends Component
{
    public $post, $count = 0;
    public $user;

    protected $listeners = [
        'refreshPostLikeComponent' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.posts.post-like-component');
    }

    public function mount($post)
    {
        $this->post = $post;
        $this->count = $post->likeCount;
        $this->user = auth()->user();
    }

    public function doLike()
    {
        $this->post->like($this->user->id);
        $this->count = $this->post->likeCount;
        dd($this->count);
        // $this->emitSelf('refreshPostLikeComponent');
    }
}
