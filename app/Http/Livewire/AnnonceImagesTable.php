<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AnnonceImages;

class AnnonceImagesTable extends DataTableComponent
{
    protected $model = AnnonceImages::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        AnnonceImages::find($id)->delete();
        Flash::success('Annonce Images deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Annonce Id", "annonce_id")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('annonce-images.show', $row->id),
                        'editUrl' => route('annonce-images.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
