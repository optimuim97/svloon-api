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
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Owner Fullname", "owner_fullname")
                ->sortable()
                ->searchable(),
            Column::make("Dialcode", "dialCode")
                ->sortable()
                ->searchable(),
            Column::make("Password", "password")
                ->sortable()
                ->searchable(),
            Column::make("Schedulestart", "scheduleStart")
                ->sortable()
                ->searchable(),
            Column::make("Scheduleend", "scheduleEnd")
                ->sortable()
                ->searchable(),
            Column::make("Schedulestr", "scheduleStr")
                ->sortable()
                ->searchable(),
            Column::make("City", "city")
                ->sortable()
                ->searchable(),
            Column::make("Phonenumber", "phoneNumber")
                ->sortable()
                ->searchable(),
            Column::make("Phone", "phone")
                ->sortable()
                ->searchable(),
            Column::make("Postalcode", "postalCode")
                ->sortable()
                ->searchable(),
            Column::make("Localnumber", "localNumber")
                ->sortable()
                ->searchable(),
            Column::make("Baildocument", "bailDocument")
                ->sortable()
                ->searchable(),
            Column::make("Salon Type Id", "salon_type_id")
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
