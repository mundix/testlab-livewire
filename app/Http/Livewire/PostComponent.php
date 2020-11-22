<?php

namespace App\Http\Livewire;

use App\Models\PostCategory;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostComponent extends Component
{
    use WithPagination;

    public $categories;
    public $category;
    public $searchQuery;

    public function render()
    {

        $posts = Post::when(!empty($this->searchQuery), function($query){
            $query->where('title', 'like', '%'.$this->searchQuery.'%');
        })
        ->when(!empty($this->category), function($query){
            $query->where('category_id', $this->category);
        })
        ->paginate(20);

        return view('livewire.post-component',
            [
                'posts' => $posts
            ]
        );
    }

    public function mount()
    {
        $this->categories = PostCategory::all();
        $this->searchQuery = '';
        $this->category = '';
    }
}
