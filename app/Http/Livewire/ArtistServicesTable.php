<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ArtistService;

class ArtistServicesTable extends DataTableComponent
{
    protected $model = ArtistService::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        ArtistService::find($id)->delete();
        Flash::success('Artist Service deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Artist Id", "artist_id")
                ->sortable()
                ->searchable(),
            Column::make("Service Id", "service_id")
                ->sortable()
                ->searchable(),
            Column::make("Is Active", "is_active")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('artist-services.show', $row->id),
                        'editUrl' => route('artist-services.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
