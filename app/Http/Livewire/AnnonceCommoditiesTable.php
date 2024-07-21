<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AnnonceCommodities;

class AnnonceCommoditiesTable extends DataTableComponent
{
    protected $model = AnnonceCommodities::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        AnnonceCommodities::find($id)->delete();
        Flash::success('Annonce Commodities deleted successfully.');
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
            Column::make("Commodity Id", "commodity_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('annonce-commodities.show', $row->id),
                        'editUrl' => route('annonce-commodities.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
