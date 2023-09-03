<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AppointmentStatus;

class AppointmentStatusesTable extends DataTableComponent
{
    protected $model = AppointmentStatus::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        AppointmentStatus::find($id)->delete();
        Flash::success('Appointment Status deleted successfully.');
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
            Column::make("Color", "color")
                ->sortable()
                ->searchable(),
            Column::make("Image", "image")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('appointment-statuses.show', $row->id),
                        'editUrl' => route('appointment-statuses.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
