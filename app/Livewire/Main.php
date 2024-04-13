<?php

namespace App\Livewire;

use App\Events\InvoiceCreated;
use App\Events\InvoiceLineItemAdded;
use App\Events\InvoiceUpdated;
use App\States\InvoiceState;
use Livewire\Component;
use Thunk\Verbs\Support\PendingEvent;

class Main extends Component
{
    public InvoiceState $invoice_state;
    public PendingEvent $invoice_updated;

    public function mount()
    {
        $event = InvoiceCreated::ephemeral(invoice_number: 'INV-'.rand(1000, 9999));

        $this->invoice_state = $event->state(InvoiceState::class);

        $this->invoice_updated = InvoiceUpdated::make(invoice_id: $this->invoice_state->id);
    }

    public function updateInvoice()
    {
        $this->invoice_updated->ephemeral();

        $this->invoice_updated = InvoiceUpdated::make(invoice_id: $this->invoice_state->id);
    }

    public function addLineItem(string $type = 'default')
    {
        InvoiceLineItemAdded::ephemeral(
            invoice_id: $this->invoice_state->id,
            type: $type,
            title: 'Line Item '.rand(1000, 9999),
            value: (string) rand(1000, 9999),
        );
    }

    public function render()
    {
        return view('livewire.main');
    }
}
