<?php

namespace App\States;

use Illuminate\Support\Collection;
use Thunk\Verbs\State;
use Thunk\Verbs\Support\StateCollection;

class InvoiceState extends State
{
    public ?string $invoice_number;
    public ?string $customer_name = null;

    public array $line_item_ids = [];

    public function addLineItem(int $line_item_id)
    {
        $this->line_item_ids[] = $line_item_id;
    }

    public function lineItems(): StateCollection
    {
        return StateCollection::loadEphemeral($this->line_item_ids, InvoiceLineItemState::class);
    }
}
