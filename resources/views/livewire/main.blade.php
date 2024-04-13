<div class="max-w-3xl mx-auto">
    <div>
        <input
            type="text"
            wire:verbs="invoice_state.customer_name, invoice_updated.customer_name"
            placeholder="Customer name"
            class="px-3 py-1 border rounded">

        <button type="button" wire:click="updateInvoice" class="px-3 py-1 border rounded hover:bg-gray-100">Update invoice</button>
        <button type="button" wire:click="$refresh">Refresh</button>
    </div>

    <div class="mt-4 p-4 border rounded-lg">
        <div>Invoice ID: {{ $this->invoice_state->id }}</div>
        <div>Invoice #: {{ $this->invoice_state->invoice_number }}</div>
        <div>Customer Name: {{ $this->invoice_state->customer_name }}</div>

        <div>
            <div>Line items:</div>

            <button type="button" wire:click="addLineItem" class="px-3 py-1 border rounded hover:bg-gray-100">Add line item</button>

            <div>
                @foreach ($this->invoice_state->line_items as $line_item)
                    <div wire:key="{{ $line_item->id }}">
                        <div>Line Item ID: {{ $line_item->id }}</div>
                        <div>Line Item Type: {{ $line_item->type }}</div>
                        <div>Line Item Title: {{ $line_item->title }}</div>
                        <div>Line Item Value: {{ $line_item->value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
