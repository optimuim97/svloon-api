<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ServiceArtist;

class ServiceArtistsTable extends DataTableComponent
{
    protected $model = ServiceArtist::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        ServiceArtist::find($id)->delete();
        Flash::success('Service Artist deleted successfully.');
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
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Price", "price")
                ->sortable()
                ->searchable(),
            Column::make("Time", "time")
                ->sortable()
                ->searchable(),
            Column::make("Salon Id", "salon_id")
                ->sortable()
                ->searchable(),
            Column::make("Service Type Id", "service_type_id")
                ->sortable()
                ->searchable(),
            Column::make("Service Place Type Id", "service_place_type_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('service-artists.show', $row->id),
                        'editUrl' => route('service-artists.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
