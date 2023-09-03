<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Message;

class MessagesTable extends DataTableComponent
{
    protected $model = Message::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Message::find($id)->delete();
        Flash::success('Message deleted successfully.');
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Conversation Id", "conversation_id")
                ->sortable()
                ->searchable(),
            Column::make("Content", "content")
                ->sortable()
                ->searchable(),
            Column::make("Is Read", "is_read")
                ->sortable()
                ->searchable(),
            Column::make("Has Edited", "has_edited")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('messages.show', $row->id),
                        'editUrl' => route('messages.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
