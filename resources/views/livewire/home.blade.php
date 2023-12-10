<div>
    <button type="button" wire:click="createQuote">Create Quote</button>

    <div>
        @foreach($this->quotes as $quote)
            <div>
                <button type="button" wire:click="approve('{{ $quote->id }}')">Approve</button>
                <pre>{{ print_r($quote->toArray()) }}</pre>
            </div>
        @endforeach
    </div>
</div>
