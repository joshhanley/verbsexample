<?php

namespace App\Events;

use App\States\InvoiceLineItemState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class InvoiceLineItemUpdated extends Event
{
    #[StateId(InvoiceLineItemState::class)]
    public ?int $line_item_id = null;

    public function __construct(
        public ?string $title,
        public ?string $value,
    ) {}

    public function applyLineItem(InvoiceLineItemState $state)
    {
        ray('applyLineItem', $state, $this->title, $this->value);
        $state->title = $this->title;
        $state->value = $this->value;
    }
}
