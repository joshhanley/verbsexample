<?php

namespace App\States;

use Thunk\Verbs\State;
use Thunk\Verbs\Support\StateCollection;
use Thunk\VerbsLivewire\Livewire\Dehydrate;

class InvoiceState extends State
{
    public ?string $invoice_number;

    public ?string $customer_name = null;

    public array $line_item_ids = [];

    public function addLineItem(int $line_item_id)
    {
        $this->line_item_ids[] = $line_item_id;
    }

    #[Dehydrate()]
    public function lineItems(): StateCollection
    {
        return StateCollection::load($this->line_item_ids, InvoiceLineItemState::class);
    }
}
