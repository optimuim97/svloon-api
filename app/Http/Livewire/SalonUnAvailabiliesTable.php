<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SalonUnAvailabily;

class SalonUnAvailabiliesTable extends DataTableComponent
{
    protected $model = SalonUnAvailabily::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        SalonUnAvailabily::find($id)->delete();
        Flash::success('Salon Un Availabily deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Date", "date")
                ->sortable()
                ->searchable(),
            Column::make("Hour Start", "hour_start")
                ->sortable()
                ->searchable(),
            Column::make("Hour End", "hour_end")
                ->sortable()
                ->searchable(),
            Column::make("Raison", "raison")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('salon-un-availabilies.show', $row->id),
                        'editUrl' => route('salon-un-availabilies.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
