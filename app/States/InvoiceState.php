<?php

namespace App\States;

use Thunk\Verbs\State;

class InvoiceState extends State
{
    public ?string $invoice_number;
    public ?string $customer_name;
}
