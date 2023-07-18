<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ServicesSalon;

class ServicesSalonsTable extends DataTableComponent
{
    protected $model = ServicesSalon::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        ServicesSalon::find($id)->delete();
        Flash::success('Services Salon deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Salon Id", "salon_id")
                ->sortable()
                ->searchable(),
            Column::make("Service Id", "service_id")
                ->sortable()
                ->searchable(),
            Column::make("Isactive", "isActive")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('services-salons.show', $row->id),
                        'editUrl' => route('services-salons.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
