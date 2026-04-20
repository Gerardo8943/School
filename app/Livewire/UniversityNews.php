<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\News;
use Livewire\WithPagination;

class UniversityNews extends Component
{
    use WithPagination;

    public function render()
    {
        // Simulated loading delay to visualize wire:loading
        usleep(500000); 
        
        $newsItems = News::orderBy('published_at', 'desc')->paginate(3);

        return view('livewire.university-news', [
            'newsItems' => $newsItems,
        ]);
    }
}
