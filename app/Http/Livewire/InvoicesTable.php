<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Invoice;

class InvoicesTable extends DataTableComponent
{
    protected $model = Invoice::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Invoice::find($id)->delete();
        Flash::success('Invoice deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Invoice Number", "invoice_number")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Quantity", "quantity")
                ->sortable()
                ->searchable(),
            Column::make("Unit", "unit")
                ->sortable()
                ->searchable(),
            Column::make("Price Ht", "price_ht")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('invoices.show', $row->id),
                        'editUrl' => route('invoices.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
