<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Annonce;

class AnnoncesTable extends DataTableComponent
{
    protected $model = Annonce::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Annonce::find($id)->delete();
        Flash::success('Annonce deleted successfully.');
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
            Column::make("Address", "address")
                ->sortable()
                ->searchable(),
            Column::make("Rating", "rating")
                ->sortable()
                ->searchable(),
            Column::make("Cover Image", "cover_image")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Salon Id", "salon_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('annonces.show', $row->id),
                        'editUrl' => route('annonces.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
