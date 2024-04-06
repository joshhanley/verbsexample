<?php

namespace App\Events;

use App\States\InvoiceState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class InvoiceCreated extends Event
{
    #[StateId(InvoiceState::class)]
    public ?int $invoice_id = null;

    public function __construct(
        public string $invoice_number,
    ) {}

    public function apply(InvoiceState $state)
    {
        $state->invoice_number = $this->invoice_number;
    }
}
