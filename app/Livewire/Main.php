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
    // use VerbsComponent;
    // #[reads('invoice_id', 'invoice1id')]
    // public AssignTask $assign;
    // public TaskState $task;
    public $invoice_id;
    public InvoiceState $invoice_state;
    public $invoice_updated;

    public function mount()
    {
        $event = InvoiceCreated::ephemeral(invoice_number: 'INV-'.rand(1000, 9999));

        $this->invoice_id = $event->invoice_id;

        $this->invoice_state = $event->state(InvoiceState::class);

        $this->invoice_updated = InvoiceUpdated::make(invoice_id: $event->invoice_id);
    }

    public function updateInvoice()
    {
        // $this->invoice_updated->event->customer_name = 'Test';
        $event = $this->invoice_updated->ephemeral();
        // $event = $this->fire('invoice_updated');
        // $fire('invoice_updated');
        // $this->invoice_state = $event->state(InvoiceState::class);

        ray($event, $this->invoice_state);
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

        ray('AddLineITem', $event, $state, $this->invoice_state);
    }

    public function render()
    {
        return view('livewire.main');
    }
}
