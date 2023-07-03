<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SalonPicture;

class SalonPicturesTable extends DataTableComponent
{
    protected $model = SalonPicture::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        SalonPicture::find($id)->delete();
        Flash::success('Salon Picture deleted successfully.');
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
            Column::make("Path", "path")
                ->sortable()
                ->searchable(),
            Column::make("Original Name", "original_name")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('salon-pictures.show', $row->id),
                        'editUrl' => route('salon-pictures.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
