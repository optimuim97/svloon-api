<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BankInfo;

class BankInfosTable extends DataTableComponent
{
    protected $model = BankInfo::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        BankInfo::find($id)->delete();
        Flash::success('Bank Info deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("User Id", "user_id")
                ->sortable()
                ->searchable(),
            Column::make("Number Surccusale", "number_surccusale")
                ->sortable()
                ->searchable(),
            Column::make("Numero Company", "numero_company")
                ->sortable()
                ->searchable(),
            Column::make("Numero Compte", "numero_compte")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('bank-infos.show', $row->id),
                        'editUrl' => route('bank-infos.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
