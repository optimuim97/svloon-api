<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointement;

class AppointementsTable extends DataTableComponent
{
    protected $model = Appointement::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Appointement::find($id)->delete();
        Flash::success('Appointement deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Creator Id", "creator_id")
                ->sortable()
                ->searchable(),
            Column::make("User Id", "user_id")
                ->sortable()
                ->searchable(),
            Column::make("Date", "date")
                ->sortable()
                ->searchable(),
            Column::make("Hour", "hour")
                ->sortable()
                ->searchable(),
            Column::make("Date Time", "date_time")
                ->sortable()
                ->searchable(),
            Column::make("Reference", "reference")
                ->sortable()
                ->searchable(),
            Column::make("Is Confirmed", "is_confirmed")
                ->sortable()
                ->searchable(),
            Column::make("Is Report", "is_report")
                ->sortable()
                ->searchable(),
            Column::make("Is Cancel", "is_cancel")
                ->sortable()
                ->searchable(),
            Column::make("Report Date", "report_date")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('appointements.show', $row->id),
                        'editUrl' => route('appointements.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
