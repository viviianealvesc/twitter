<?php

namespace App\Livewire\Tweet;

use App\Models\Tweet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    
    public $body = null;

    public function render()
    {
        return view('livewire.tweet.create');
    }

    public function tweet() {

        $this->authorize('create', Tweet::class);

        $this->validate([
            'body' => ['required', 'max:140']
        ]);

        Tweet::query()->create([
            'body' => $this->body,
            'created_by' => auth()->id(),
        ]);

        $this->emit('tweet::created');
    }
}
