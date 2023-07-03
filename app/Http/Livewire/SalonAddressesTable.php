<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SalonAddress;

class SalonAddressesTable extends DataTableComponent
{
    protected $model = SalonAddress::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        SalonAddress::find($id)->delete();
        Flash::success('Salon Address deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Lat", "lat")
                ->sortable()
                ->searchable(),
            Column::make("Lon", "lon")
                ->sortable()
                ->searchable(),
            Column::make("Address Name", "address_name")
                ->sortable()
                ->searchable(),
            Column::make("Salon Id", "salon_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('salon-addresses.show', $row->id),
                        'editUrl' => route('salon-addresses.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
