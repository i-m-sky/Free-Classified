<?php

namespace App\Http\Livewire\Members\Posts;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CartPage extends Component
{

    public function render()
    {
        return view('livewire.members.posts.cart-page');
    }
}
