<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConversationRequest;
use App\Http\Requests\UpdateConversationRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ConversationRepository;
use Illuminate\Http\Request;
use Flash;

class ConversationController extends AppBaseController
{
    /** @var ConversationRepository $conversationRepository*/
    private $conversationRepository;

    public function __construct(ConversationRepository $conversationRepo)
    {
        $this->conversationRepository = $conversationRepo;
    }

    /**
     * Display a listing of the Conversation.
     */
    public function index(Request $request)
    {
        return view('conversations.index');
    }

    /**
     * Show the form for creating a new Conversation.
     */
    public function create()
    {
        return view('conversations.create');
    }

    /**
     * Store a newly created Conversation in storage.
     */
    public function store(CreateConversationRequest $request)
    {
        $input = $request->all();

        $conversation = $this->conversationRepository->create($input);

        Flash::success('Conversation saved successfully.');

        return redirect(route('conversations.index'));
    }

    /**
     * Display the specified Conversation.
     */
    public function show($id)
    {
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            Flash::error('Conversation not found');

            return redirect(route('conversations.index'));
        }

        return view('conversations.show')->with('conversation', $conversation);
    }

    /**
     * Show the form for editing the specified Conversation.
     */
    public function edit($id)
    {
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            Flash::error('Conversation not found');

            return redirect(route('conversations.index'));
        }

        return view('conversations.edit')->with('conversation', $conversation);
    }

    /**
     * Update the specified Conversation in storage.
     */
    public function update($id, UpdateConversationRequest $request)
    {
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            Flash::error('Conversation not found');

            return redirect(route('conversations.index'));
        }

        $conversation = $this->conversationRepository->update($request->all(), $id);

        Flash::success('Conversation updated successfully.');

        return redirect(route('conversations.index'));
    }

    /**
     * Remove the specified Conversation from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            Flash::error('Conversation not found');

            return redirect(route('conversations.index'));
        }

        $this->conversationRepository->delete($id);

        Flash::success('Conversation deleted successfully.');

        return redirect(route('conversations.index'));
    }
}
