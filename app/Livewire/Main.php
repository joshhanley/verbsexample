<?php

namespace App\Livewire;

use App\Events\InvoiceCreated;
use App\Events\InvoiceUpdated;
use App\States\InvoiceState;
use Livewire\Component;

class Main extends Component
{
    public $invoice_id;

    public function mount()
    {
        $event = InvoiceCreated::ephemeral(invoice_number: 'INV-'.rand(1000, 9999));

        $state = InvoiceState::loadEphemeral($event->invoice_id);

        ray($event, $state);

        $this->invoice_id = $event->invoice_id;
    }

    public function updateInvoice()
    {
        $event = InvoiceUpdated::ephemeral(invoice_id: $this->invoice_id, customer_name: 'John Doe');

        $state = InvoiceState::loadEphemeral($this->invoice_id);

        ray($event, $state);
    }

    public function render()
    {
        return view('livewire.main');
    }
}
