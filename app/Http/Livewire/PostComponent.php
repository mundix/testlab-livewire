<?php

namespace App\Http\Livewire;

use App\Models\PostCategory;
use Livewire\Component;

class PostComponent extends Component
{

    public $categories;
    public $category;

    public function render()
    {
        return view('livewire.post-component');
    }

    public function mount()
    {
        $this->categories = PostCategory::all();
    }
}
