<div>
    <button type="button" wire:click="$refresh">Refresh</button>
    <input type="text" wire:model="invoice_updated.customer_name" placeholder="Customer name">
    <button type="button" wire:click="updateInvoice">Update invoice</button>
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