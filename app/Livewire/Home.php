<?php

namespace App\Livewire;

use App\Events\QuoteCreated;
use App\Models\Quote;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Home extends Component
{
    public function createQuote()
    {
        ray('creating quote');
        QuoteCreated::fire(
            code: 'QUOTE-001',
            notes: 'Note about a quote',
            customer_id: 5,
        );
    }

    #[Computed]
    public function quotes()
    {
        ray('getting quotes from computed');
        return ray()->pass(Quote::all());
    }

    public function render()
    {
        return view('livewire.home');
    }
}
