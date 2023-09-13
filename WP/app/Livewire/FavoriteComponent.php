<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Favorite;


class FavoriteComponent extends Component
{
    public $catId;
    public $isFavorited;

    public function mount($catId)
    {
        $this->catId = $catId;
        $this->isFavorited = auth()->user()->favoriteCats->contains($catId);
    }

    public function toggleFavorite()
    {
        if ($this->isFavorited) {
            Favorite::where('user_id', auth()->id())->where('cat_id', $this->catId)->delete();
            $this->isFavorited = false;
        } else {
            Favorite::create(['user_id' => auth()->id(), 'cat_id' => $this->catId]);
            $this->isFavorited = true;
        }
    }

    public function render()
    {
        return view('livewire.favorite');
    }
}
