<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Matching;

class ComebackModal extends Component
{
    public $showModal = false;
    public $cat_id;
    public $user_id;

    public function mount($cat_id, $user_id)
    {
        $this->cat_id = $cat_id;
        $this->user_id = $user_id;
    }


    public function render()
    {

        return view('livewire.comeback-modal');
    }

    public function openModal()
    {
        $this->showModal = true;
    }
 
    public function closeModal()
    {
        $this->showModal = false;
    }

    public function executeComeback()
    {
        // 必要な変数の取得（例えば$matchingの取得）
        $matching = Matching::where('cat_id', $this->cat_id)->where('user_id', auth()->id())->first();

        // ルーティングの処理
        return redirect()->route('comeback', ['cat' => $matching->cat->id, 'user' => auth()->id()]);
    }

}
