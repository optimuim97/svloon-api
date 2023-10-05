<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ArtistPorfolio;

class ArtistPorfoliosTable extends DataTableComponent
{
    protected $model = ArtistPorfolio::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        ArtistPorfolio::find($id)->delete();
        Flash::success('Artist Porfolio deleted successfully.');
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
            Column::make("Imageurl", "imageUrl")
                ->sortable()
                ->searchable(),
            Column::make("Creator Name", "creator_name")
                ->sortable()
                ->searchable(),
            Column::make("Artist Id", "artist_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('artist-porfolios.show', $row->id),
                        'editUrl' => route('artist-porfolios.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
