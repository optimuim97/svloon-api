<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Conversation;

class ConversationsTable extends DataTableComponent
{
    protected $model = Conversation::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Conversation::find($id)->delete();
        Flash::success('Conversation deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Person Id", "person_id")
                ->sortable()
                ->searchable(),
            Column::make("Person Id", "person_id")
                ->sortable()
                ->searchable(),
            Column::make("User Types", "user_types")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('conversations.show', $row->id),
                        'editUrl' => route('conversations.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
