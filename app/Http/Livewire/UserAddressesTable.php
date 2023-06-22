<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserAddress;

class UserAddressesTable extends DataTableComponent
{
    protected $model = UserAddress::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        UserAddress::find($id)->delete();
        Flash::success('User Address deleted successfully.');
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
            Column::make("User Id", "user_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('user-addresses.show', $row->id),
                        'editUrl' => route('user-addresses.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
