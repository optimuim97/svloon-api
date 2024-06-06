<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Accessoire;

class AccessoiresTable extends DataTableComponent
{
    protected $model = Accessoire::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Accessoire::find($id)->delete();
        Flash::success('Accessoire deleted successfully.');
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
            Column::make("Icone", "icone")
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value) => view('common.livewire-tables.column-image', [
                        'url' => $value
                    ])
                ),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('accessoires.show', $row->id),
                        'editUrl' => route('accessoires.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
