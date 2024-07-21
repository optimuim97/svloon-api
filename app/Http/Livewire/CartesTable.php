<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Carte;

class CartesTable extends DataTableComponent
{
    protected $model = Carte::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Carte::find($id)->delete();
        Flash::success('Carte deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Designation", "designation")
                ->sortable()
                ->searchable(),
            Column::make("Carte Number", "carte_number")
                ->sortable()
                ->searchable(),
            Column::make("Date Exp", "date_exp")
                ->sortable()
                ->searchable(),
            Column::make("Cvv", "cvv")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('cartes.show', $row->id),
                        'editUrl' => route('cartes.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
