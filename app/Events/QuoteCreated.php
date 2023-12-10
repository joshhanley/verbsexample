<?php

namespace App\Events;

use App\Models\Quote;
use App\States\QuoteState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class QuoteCreated extends Event
{
    #[StateId(QuoteState::class)]
    public ?int $quote_id = null;

    public function __construct(
        public string $code,
        public string $notes,
        public ?int $customer_id = null,
    ) {}

    public function apply(QuoteState $state)
    {
        // ray('apply');
        $state->code = $this->code;
        $state->notes = $this->notes;
        $state->customer_id = $this->customer_id;

        // ray($state);
    }

    public function handle()
    {
        // ray('handle');
        Quote::create([
            'id' => $this->quote_id,
            'code' => $this->code,
            'status' => 'draft',
            'notes' => $this->notes,
            'customer_id' => $this->customer_id,
        ]);
    }
}
