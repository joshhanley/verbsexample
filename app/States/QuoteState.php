<?php

namespace App\States;

use Thunk\Verbs\State;

class QuoteState extends State
{
    public string $code = '';
    public string $notes = '';
    public ?int $customer_id = null;
}
