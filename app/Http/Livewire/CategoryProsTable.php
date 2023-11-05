<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CategoryPro;

class CategoryProsTable extends DataTableComponent
{
    protected $model = CategoryPro::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        CategoryPro::find($id)->delete();
        Flash::success('Category Pro deleted successfully.');
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
                        'showUrl' => route('category-pros.show', $row->id),
                        'editUrl' => route('category-pros.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
