<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AnnonceOrder;

class AnnonceOrdersTable extends DataTableComponent
{
    protected $model = AnnonceOrder::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        AnnonceOrder::find($id)->delete();
        Flash::success('Annonce Order deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Annonce Id", "annonce_id")
                ->sortable()
                ->searchable(),
            Column::make("Order Status Id", "order_status_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('annonce-orders.show', $row->id),
                        'editUrl' => route('annonce-orders.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
