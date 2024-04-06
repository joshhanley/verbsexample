<?php

namespace App\Livewire;

use App\Events\InvoiceCreated;
use App\Events\InvoiceUpdated;
use App\States\InvoiceState;
use Livewire\Component;

class Main extends Component
{
    public $invoice_updated;

    public function mount()
    {
        $event = InvoiceCreated::ephemeral(invoice_number: 'INV-'.rand(1000, 9999));

        $state = $event->state(InvoiceState::class);

        ray($event, $state);

        $this->invoice_updated = InvoiceUpdated::make(invoice_id: $event->invoice_id);
    }

    public function updateInvoice()
    {
        $event = $this->invoice_updated->ephemeral();
        $state = $event->state(InvoiceState::class);

        ray($event, $state);
    }

    public function render()
    {
        return view('livewire.main');
    }
}
