<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class PostLikeComponent extends Component
{
    public $post, $count = 0;
    public $user, $liked = false;

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
        $this->liked = $this->count ? true:false;
        $this->user = auth()->user();
    }

    public function doLike()
    {
        if(!$this->post->liked())
        {

            $this->post->like();
            $this->count = $this->post->likeCount;
            $this->count = $this->count + 1;
            $this->emitSelf('refreshPostLikeComponent');

        }else{

            $this->post->unlike();
            $this->count = $this->post->likeCount;

            if($this->count > 0)
                $this->count = $this->count - 1;

        }

        $this->liked = $this->count ? true:false;

    }
}
