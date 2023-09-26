<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ArtistAddress;

class ArtistAddressesTable extends DataTableComponent
{
    protected $model = ArtistAddress::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        ArtistAddress::find($id)->delete();
        Flash::success('Artist Address deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Address Name", "address_name")
                ->sortable()
                ->searchable(),
            Column::make("Lat", "lat")
                ->sortable()
                ->searchable(),
            Column::make("Lon", "lon")
                ->sortable()
                ->searchable(),
            Column::make("Artist Id", "artist_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('artist-addresses.show', $row->id),
                        'editUrl' => route('artist-addresses.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
