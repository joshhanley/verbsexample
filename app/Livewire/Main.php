<?php

namespace App\Livewire;

use App\Events\InvoiceCreated;
use Livewire\Component;

class Main extends Component
{
    public function mount()
    {
        InvoiceCreated::ephemeral('INV-'.rand(1000, 9999));
    }

    public function createInvoice()
    {
        InvoiceCreated::ephemeral('INV-'.rand(1000, 9999));
    }

    public function render()
    {
        return view('livewire.main');
    }
}
