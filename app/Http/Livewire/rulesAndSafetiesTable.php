<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\rulesAndSafety;

class rulesAndSafetiesTable extends DataTableComponent
{
    protected $model = rulesAndSafety::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        rulesAndSafety::find($id)->delete();
        Flash::success('Rules And Safety deleted successfully.');
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
                        'showUrl' => route('rules-and-safeties.show', $row->id),
                        'editUrl' => route('rules-and-safeties.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
