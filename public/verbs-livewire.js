document.addEventListener("livewire:init", () => {
    let verbsScripts = document.querySelector('[verbs\\:snapshot]');

    if (!verbsScripts) {
        console.warn('Livewire Verbs: No Verbs snapshot found in the DOM.')

        return
    }

    // Get the value of the 'verbs-snapshot' attribute
    let verbsSnapshotEncoded = verbsScripts.getAttribute('verbs:snapshot')

    let Verbs = {}
    window.Verbs = Verbs

    Verbs.events = JSON.parse(verbsSnapshotEncoded)

    Livewire.hook("request", ({ uri, options, payload, respond, succeed, fail }) => {
        let body = JSON.parse(options.body)

        body.verbs = { events: Verbs.events }

        options.body = JSON.stringify(body)

        succeed(({ status, json }) => {
            Verbs.events = json.verbs.events

            console.log("Verbs", Verbs)
        })
    })

    Livewire.directive("verbs", ({ el, directive, component, cleanup }) => {
        let { expression, modifiers } = directive

        if (!expression) {
            console.error("The `wire:verbs` directive requires an expression.")
        }

        let [getValue, setValue] = expression.split(",").map((verb) => verb.trim())

        console.log("Verbs", getValue, setValue)

        Alpine.bind(el, {
            ["x-model"]() {
                return {
                    get() {
                        return dataGet(component.$wire, getValue)
                    },
                    set(value) {
                        dataSet(component.$wire, setValue, value)
                    },
                }
            },
        })
    })
})

// Copied from vendor/livewire/livewire/js/utils.js
function dataGet(object, key) {
    if (key === "") return object

    return key.split(".").reduce((carry, i) => {
        if (carry === undefined) return undefined

        return carry[i]
    }, object)
}

// Copied from vendor/livewire/livewire/js/utils.js
function dataSet(object, key, value) {
    let segments = key.split(".")

    if (segments.length === 1) {
        return (object[key] = value)
    }

    let firstSegment = segments.shift()
    let restOfSegments = segments.join(".")

    if (object[firstSegment] === undefined) {
        object[firstSegment] = {}
    }

    dataSet(object[firstSegment], restOfSegments, value)
}
