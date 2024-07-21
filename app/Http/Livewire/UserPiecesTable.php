<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserPiece;

class UserPiecesTable extends DataTableComponent
{
    protected $model = UserPiece::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        UserPiece::find($id)->delete();
        Flash::success('User Piece deleted successfully.');
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
                        'showUrl' => route('user-pieces.show', $row->id),
                        'editUrl' => route('user-pieces.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
