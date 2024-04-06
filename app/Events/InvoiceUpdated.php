<?php

namespace App\Events;

use App\States\InvoiceState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class InvoiceUpdated extends Event
{
    public function __construct(
        #[StateId(InvoiceState::class)]
        public int $invoice_id,
        public string $customer_name,
    ) {}

    public function apply(InvoiceState $state)
    {
        $state->customer_name = $this->customer_name;
    }
}
