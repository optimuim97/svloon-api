<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPieceRequest;
use App\Http\Requests\UpdateUserPieceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserPieceRepository;
use Illuminate\Http\Request;
use Flash;

class UserPieceController extends AppBaseController
{
    /** @var UserPieceRepository $userPieceRepository*/
    private $userPieceRepository;

    public function __construct(UserPieceRepository $userPieceRepo)
    {
        $this->userPieceRepository = $userPieceRepo;
    }

    /**
     * Display a listing of the UserPiece.
     */
    public function index(Request $request)
    {
        return view('user_pieces.index');
    }

    /**
     * Show the form for creating a new UserPiece.
     */
    public function create()
    {
        return view('user_pieces.create');
    }

    /**
     * Store a newly created UserPiece in storage.
     */
    public function store(CreateUserPieceRequest $request)
    {
        $input = $request->all();

        $userPiece = $this->userPieceRepository->create($input);

        Flash::success('User Piece saved successfully.');

        return redirect(route('.index'));
    }

    /**
     * Display the specified UserPiece.
     */
    public function show($id)
    {
        $userPiece = $this->userPieceRepository->find($id);

        if (empty($userPiece)) {
            Flash::error('User Piece not found');

            return redirect(route('.index'));
        }

        return view('user_pieces.show')->with('userPiece', $userPiece);
    }

    /**
     * Show the form for editing the specified UserPiece.
     */
    public function edit($id)
    {
        $userPiece = $this->userPieceRepository->find($id);

        if (empty($userPiece)) {
            Flash::error('User Piece not found');

            return redirect(route('.index'));
        }

        return view('user_pieces.edit')->with('userPiece', $userPiece);
    }

    /**
     * Update the specified UserPiece in storage.
     */
    public function update($id, UpdateUserPieceRequest $request)
    {
        $userPiece = $this->userPieceRepository->find($id);

        if (empty($userPiece)) {
            Flash::error('User Piece not found');

            return redirect(route('.index'));
        }

        $userPiece = $this->userPieceRepository->update($request->all(), $id);

        Flash::success('User Piece updated successfully.');

        return redirect(route('.index'));
    }

    /**
     * Remove the specified UserPiece from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userPiece = $this->userPieceRepository->find($id);

        if (empty($userPiece)) {
            Flash::error('User Piece not found');

            return redirect(route('.index'));
        }

        $this->userPieceRepository->delete($id);

        Flash::success('User Piece deleted successfully.');

        return redirect(route('.index'));
    }
}
