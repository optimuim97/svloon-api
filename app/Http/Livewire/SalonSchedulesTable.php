<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SalonSchedule;

class SalonSchedulesTable extends DataTableComponent
{
    protected $model = SalonSchedule::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        SalonSchedule::find($id)->delete();
        Flash::success('Salon Schedule deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Start Day", "start_day")
                ->sortable()
                ->searchable(),
            Column::make("End Dat", "end_dat")
                ->sortable()
                ->searchable(),
            Column::make("Start Hour", "start_hour")
                ->sortable()
                ->searchable(),
            Column::make("End Hour", "end_hour")
                ->sortable()
                ->searchable(),
            Column::make("Pause Start", "pause_start")
                ->sortable()
                ->searchable(),
            Column::make("Pause End", "pause_end")
                ->sortable()
                ->searchable(),
            Column::make("Is Active", "is_active")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('salon-schedules.show', $row->id),
                        'editUrl' => route('salon-schedules.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
