<?php

namespace App\Events;

use App\States\InvoiceLineItemState;
use App\States\InvoiceState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class InvoiceLineItemAdded extends Event
{
    #[StateId(InvoiceLineItemState::class)]
    public ?int $line_item_id = null;

    public function __construct(
        #[StateId(InvoiceState::class)]
        public int $invoice_id,
        public string $type,
        public ?string $title,
        public ?string $value,
    ) {}

    public function applyInvoice(InvoiceState $state)
    {
        $state->addLineItem($this->line_item_id);
    }

    public function applyLineItem(InvoiceLineItemState $state)
    {
        $state->invoice_id = $this->invoice_id;
        $state->type = $this->type;
        $state->title = $this->title;
        $state->value = $this->value;
    }
}
