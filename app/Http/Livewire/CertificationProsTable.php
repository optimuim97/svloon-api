<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CertificationPro;

class CertificationProsTable extends DataTableComponent
{
    protected $model = CertificationPro::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        CertificationPro::find($id)->delete();
        Flash::success('Certification Pro deleted successfully.');
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
            Column::make("File", "file")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('certification-pros.show', $row->id),
                        'editUrl' => route('certification-pros.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
