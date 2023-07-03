<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Salon;

class SalonsTable extends DataTableComponent
{
    protected $model = Salon::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Salon::find($id)->delete();
        Flash::success('Salon deleted successfully.');
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
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Imageurl", "imageUrl")
                ->sortable()
                ->searchable(),
            Column::make("Aboutus", "aboutUs")
                ->sortable()
                ->searchable(),
            Column::make("Schedule", "schedule")
                ->sortable()
                ->searchable(),
            Column::make("Schedule", "schedule")
                ->sortable()
                ->searchable(),
            Column::make("Schedule", "schedule")
                ->sortable()
                ->searchable(),
            Column::make("User Id", "user_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('salons.show', $row->id),
                        'editUrl' => route('salons.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
