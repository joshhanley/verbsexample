<?php

namespace App\Livewire;

use App\Events\InvoiceCreated;
use App\Events\InvoiceLineItemAdded;
use App\Events\InvoiceLineItemUpdated;
use App\Events\InvoiceUpdated;
use App\States\InvoiceState;
use Illuminate\Support\Str;
use Livewire\Component;
use Thunk\Verbs\Facades\Verbs;
use Thunk\Verbs\Support\PendingEvent;

class Main extends Component
{
    public InvoiceState $invoice_state;

    public PendingEvent $invoice_updated;

    public array $line_items = [];

    public function boot()
    {
        Verbs::use('standalone');
    }

    public function mount()
    {
        $event = InvoiceCreated::fire(invoice_number: 'INV-'.rand(1000, 9999));

        $this->invoice_state = $event->state(InvoiceState::class);

        $this->invoice_updated = InvoiceUpdated::make(invoice_id: $this->invoice_state->id);
    }

    public function updateInvoice()
    {
        $event = $this->invoice_updated->fire();

        $this->invoice_updated = InvoiceUpdated::make(invoice_id: $this->invoice_state->id);
    }

    public function updatedLineItems($value, $key)
    {
        $index = Str::before($key, '.');

        ray($this->line_items);

        $this->line_items[$index]->fire();

        $this->line_items[$index] = InvoiceLineItemUpdated::make(line_item_id: (int) $index);

        $this->invoice_state = InvoiceState::load($this->invoice_state->id);

        ray($this->invoice_state, $this->invoice_state->line_items);
    }

    public function addLineItem(string $type = 'default')
    {
        $event = InvoiceLineItemAdded::fire(
            invoice_id: $this->invoice_state->id,
            type: $type,
            title: 'Line Item '.rand(1000, 9999),
            value: (string) rand(1000, 9999),
        );

        $this->line_items[$event->line_item_id] = InvoiceLineItemUpdated::make(line_item_id: $event->line_item_id);
    }

    public function render()
    {
        return view('livewire.main');
    }
}
