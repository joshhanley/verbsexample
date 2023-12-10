<?php

namespace App\Livewire;

use App\Events\QuoteApproved;
use App\Events\QuoteCreated;
use App\Models\Quote;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Home extends Component
{
    #[Computed]
    public function quotes()
    {
        // ray('getting quotes from computed');

        return Quote::all();
    }

    public function createQuote()
    {
        // ray('creating quote');
        QuoteCreated::fire(
            code: 'QUOTE-001',
            notes: 'Note about a quote',
            customer_id: 5,
        );
    }

    public function approve($quoteId)
    {
        ray('fireQuoteApproved', $quoteId);
        QuoteApproved::fire(
            quote_id: $quoteId,
        );
    }

    public function render()
    {
        return view('livewire.home');
    }
}
