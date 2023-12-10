<?php

namespace App\Events;

use App\Models\Quote;
use App\States\QuoteState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class QuoteApproved extends Event
{
    #[StateId(QuoteState::class)]
    public string $quote_id;

    public function authorize(QuoteState $state)
    {
        ray('authorize');

        return true;
    }

    public function validate(QuoteState $state)
    {
        ray('validate');

        $this->assert($state->status === 'draft', 'Quote must be in draft status to approve.');
    }

    public function apply(QuoteState $state)
    {
        ray('apply');

        $state->status = 'approved';
    }

    public function handle()
    {
        ray('handle');

        ray($this->quote_id);

        ray(Quote::all());

        Quote::find($this->quote_id)
            ->update(['status' => 'approved']);
    }
}
