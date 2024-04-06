<div>
    <button type="button" wire:click="$refresh">Refresh</button>
    <button type="button" wire:click="createInvoice">Create invoice</button>
</div>

<script>
    @ray(app(\Thunk\Verbs\Lifecycle\EphemeralEventQueue::class))
    document.addEventListener('livewire:init', () => {
        let Verbs = {}
        window.Verbs = Verbs

        Verbs.events = @js(app(\Thunk\Verbs\Lifecycle\EphemeralEventQueue::class)->dehydrate())

        console.log('Verbs', Verbs)

        /*Livewire.hook('effect', ({ component, effects, cleanup }) => {
            console.log('effect', component, effects, cleanup)

            if (! effects.verbs) return

            Verbs.events = effects.verbs.events
        })*/

        Livewire.hook('request', ({ uri, options, payload, respond, succeed, fail }) => {
            console.log('request', options)
            
            let body = JSON.parse(options.body)

            body.verbs = { events: Verbs.events }

            options.body = JSON.stringify(body)

            console.log('options', options)
            succeed(({ status, json }) => {
                Verbs.events = json.verbs.events

                console.log('Verbs', Verbs)
            })
        })
    })
</script>