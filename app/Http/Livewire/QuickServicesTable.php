<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\QuickService;

class QuickServicesTable extends DataTableComponent
{
    protected $model = QuickService::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        QuickService::find($id)->delete();
        Flash::success('Quick Service deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Service Id", "service_id")
                ->sortable()
                ->searchable(),
            Column::make("Address", "address")
                ->sortable()
                ->searchable(),
            Column::make("Lat", "lat")
                ->sortable()
                ->searchable(),
            Column::make("Lon", "lon")
                ->sortable()
                ->searchable(),
            Column::make("User Id", "user_id")
                ->sortable()
                ->searchable(),
            Column::make("Duration", "duration")
                ->sortable()
                ->searchable(),
            Column::make("Isconfirmed", "isConfirmed")
                ->sortable()
                ->searchable(),
            Column::make("Hasalreadysendremeber", "hasAlreadySendRemeber")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('quick-services.show', $row->id),
                        'editUrl' => route('quick-services.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
