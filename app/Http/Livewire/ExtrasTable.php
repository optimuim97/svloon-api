<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Extra;

class ExtrasTable extends DataTableComponent
{
    protected $model = Extra::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Extra::find($id)->delete();
        Flash::success('Extra deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Prix", "prix")
                ->sortable()
                ->searchable(),
            Column::make("Ext Time", "ext_time")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('extras.show', $row->id),
                        'editUrl' => route('extras.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
