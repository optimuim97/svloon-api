<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ArtistPicture;

class ArtistPicturesTable extends DataTableComponent
{
    protected $model = ArtistPicture::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        ArtistPicture::find($id)->delete();
        Flash::success('Artist Picture deleted successfully.');
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
            Column::make("Path", "path")
                ->sortable()
                ->searchable(),
            Column::make("Original Name", "original_name")
                ->sortable()
                ->searchable(),
            Column::make("Artist Id", "artist_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('artist-pictures.show', $row->id),
                        'editUrl' => route('artist-pictures.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
