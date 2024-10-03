<?php

namespace App\Livewire\Tweet;

use App\Models\Tweet;
use Livewire\Component;

class Create extends Component
{
    public $body = null;

    public function render()
    {
        return view('livewire.tweet.create');
    }

    public function tweet() {

        Tweet::query()->create([
            'body' => $this->body,
            'created_by' => auth()->id(),
        ]);

        $this->emit('tweet::created');
    }
}
