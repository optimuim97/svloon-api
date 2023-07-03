<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SalonTypeAccount;

class SalonTypeAccountsTable extends DataTableComponent
{
    protected $model = SalonTypeAccount::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        SalonTypeAccount::find($id)->delete();
        Flash::success('Salon Type Account deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Label", "label")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('salon-type-accounts.show', $row->id),
                        'editUrl' => route('salon-type-accounts.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
