<?php

namespace App\Livewire;

use App\Models\Tenant\Lead;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class LeadComponent extends Component
{
    use WithPagination;

    public ?int $quantity = 5;

    public ?string $search = null;

    public array $headers = [
                ['index' => 'id', 'label' => '#'],
                ['index' => 'name', 'label' => 'Name'],
                ['index' => 'email', 'label' => 'Email'],
                ['index' => 'phone', 'label' => 'Phone'],
                ['index' => 'created_at', 'label' => 'Created At']
    ];

    public function render(): View
    {
        return view('livewire.lead-component', [
            'rows' => Lead::query()
                ->when($this->search, function ($query, $search) {
                    $this->search = trim($search);

                    return $query->whereAny([
                        'name',
                        'email',
                        'phone',
                    ], 'like', "%{$this->search}%");
                })
                ->paginate($this->quantity)
                ->withQueryString(),
        ]);
    }
}
