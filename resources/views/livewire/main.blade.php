<div class="max-w-3xl mx-auto">
    <button type="button" wire:click="$refresh" class="px-3 py-1 border rounded hover:bg-gray-100">Refresh</button>
    <input type="text" wire:model="invoice_updated.customer_name" placeholder="Customer name" class="px-3 py-1 border rounded">
    <button type="button" wire:click="updateInvoice" class="px-3 py-1 border rounded hover:bg-gray-100">Update invoice</button>
    <button type="button" wire:click="addLineItem" class="px-3 py-1 border rounded hover:bg-gray-100">Add line item</button>

    <div class="mt-4 p-4 border rounded-lg">
        <div>Invoice ID: {{ $this->invoice->id }}</div>
        <div>Invoice #: {{ $this->invoice->invoice_number }}</div>
        <div>Customer Name: {{ $this->invoice->customer_name }}</div>

        <div>
            <div>Line items:</div>

            <div>
                @foreach ($this->invoice->line_items as $line_item)
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

<script>
    @ray(app(\Thunk\Verbs\Lifecycle\EphemeralEventQueue::class))
    document.addEventListener('livewire:init', () => {
        let Verbs = {}
        window.Verbs = Verbs

        Verbs.events = @js(app(\Thunk\Verbs\Lifecycle\EphemeralEventQueue::class)->dehydrate())

        Livewire.hook('request', ({ uri, options, payload, respond, succeed, fail }) => {
            let body = JSON.parse(options.body)

            body.verbs = { events: Verbs.events }

            options.body = JSON.stringify(body)

            succeed(({ status, json }) => {
                Verbs.events = json.verbs.events

                console.log('Verbs', Verbs)
            })
        })
    })
</script>