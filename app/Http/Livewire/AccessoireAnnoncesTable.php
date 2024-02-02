<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AccessoireAnnonce;

class AccessoireAnnoncesTable extends DataTableComponent
{
    protected $model = AccessoireAnnonce::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        AccessoireAnnonce::find($id)->delete();
        Flash::success('Accessoire Annonce deleted successfully.');
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
            Column::make("Accessoire Id", "accessoire_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('accessoire-annonces.show', $row->id),
                        'editUrl' => route('accessoire-annonces.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
