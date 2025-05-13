<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class FeaturedArticles extends Component
{
    public $featured_articles = [];

    public function mount()
    {
        // $this->featured_articles = Article::where('is_featured', 1)->get();
    }

    public function render()
    {
        return view('livewire.frontend.featured-articles');
    }
}