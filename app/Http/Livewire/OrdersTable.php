<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;

class OrdersTable extends DataTableComponent
{
    protected $model = Order::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Order::find($id)->delete();
        Flash::success('Order deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Salon Id", "salon_id")
                ->sortable()
                ->searchable(),
            Column::make("Artist Id", "artist_id")
                ->sortable()
                ->searchable(),
            Column::make("Details", "details")
                ->sortable()
                ->searchable(),
            Column::make("Instructions", "instructions")
                ->sortable()
                ->searchable(),
            Column::make("Total Price", "total_price")
                ->sortable()
                ->searchable(),
            Column::make("Date", "date")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('orders.show', $row->id),
                        'editUrl' => route('orders.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
