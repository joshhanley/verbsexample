<div>
    <button type="button" wire:click="createQuote">Create Quote</button>

    <div>
        @foreach($this->quotes as $quote)
            <pre>{{ print_r($quote) }}</pre>
        @endforeach
    </div>
</div>
