<?php

namespace App\Livewire;

use App\Events\InvoiceCreated;
use App\Events\InvoiceLineItemAdded;
use App\Events\InvoiceUpdated;
use App\States\InvoiceLineItemState;
use App\States\InvoiceState;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Main extends Component
{
    public $invoice_id;
    public $invoice_updated;

    #[Computed]
    public function invoice(): InvoiceState
    {
        return InvoiceState::loadEphemeral($this->invoice_id);
    }

    public function mount()
    {
        $event = InvoiceCreated::ephemeral(invoice_number: 'INV-'.rand(1000, 9999));

        $this->invoice_id = $event->invoice_id;

        $state = $event->state(InvoiceState::class);

        $this->invoice_updated = InvoiceUpdated::make(invoice_id: $event->invoice_id);
    }

    public function updateInvoice()
    {
        $event = $this->invoice_updated->ephemeral();
        $state = $event->state(InvoiceState::class);

        ray($event, $state);
    }

    public function addLineItem(string $type = 'default')
    {
        ray('addLineItem');
        $event = InvoiceLineItemAdded::ephemeral(
            invoice_id: $this->invoice_id,
            type: $type,
            title: 'Line Item '.rand(1000, 9999),
            value: (string) rand(1000, 9999),
        );

        $state = $event->state(InvoiceLineItemState::class);

        ray('AddLineITem', $event, $state, $this->invoice);
    }

    public function render()
    {
        return view('livewire.main');
    }
}
