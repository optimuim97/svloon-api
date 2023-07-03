<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ServicePlaceType;

class ServicePlaceTypesTable extends DataTableComponent
{
    protected $model = ServicePlaceType::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        ServicePlaceType::find($id)->delete();
        Flash::success('Service Place Type deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Label", "label")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('service-place-types.show', $row->id),
                        'editUrl' => route('service-place-types.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
