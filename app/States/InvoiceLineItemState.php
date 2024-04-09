<?php

namespace App\States;

use Illuminate\Support\Collection;
use Thunk\Verbs\State;

class InvoiceLineItemState extends State
{
    public ?int $invoice_id;
    public ?string $type;
    public ?string $title;
    public ?string $value;
    public ?Collection $children;
}
