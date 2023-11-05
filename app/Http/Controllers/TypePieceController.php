<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTypePieceRequest;
use App\Http\Requests\UpdateTypePieceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TypePieceRepository;
use Illuminate\Http\Request;
use Flash;

class TypePieceController extends AppBaseController
{
    /** @var TypePieceRepository $typePieceRepository*/
    private $typePieceRepository;

    public function __construct(TypePieceRepository $typePieceRepo)
    {
        $this->typePieceRepository = $typePieceRepo;
    }

    /**
     * Display a listing of the TypePiece.
     */
    public function index(Request $request)
    {
        return view('type_pieces.index');
    }

    /**
     * Show the form for creating a new TypePiece.
     */
    public function create()
    {
        return view('type_pieces.create');
    }

    /**
     * Store a newly created TypePiece in storage.
     */
    public function store(CreateTypePieceRequest $request)
    {
        $input = $request->all();

        $typePiece = $this->typePieceRepository->create($input);

        Flash::success('Type Piece saved successfully.');

        return redirect(route('type-pieces.index'));
    }

    /**
     * Display the specified TypePiece.
     */
    public function show($id)
    {
        $typePiece = $this->typePieceRepository->find($id);

        if (empty($typePiece)) {
            Flash::error('Type Piece not found');

            return redirect(route('type-pieces.index'));
        }

        return view('type_pieces.show')->with('typePiece', $typePiece);
    }

    /**
     * Show the form for editing the specified TypePiece.
     */
    public function edit($id)
    {
        $typePiece = $this->typePieceRepository->find($id);

        if (empty($typePiece)) {
            Flash::error('Type Piece not found');

            return redirect(route('type-pieces.index'));
        }

        return view('type_pieces.edit')->with('typePiece', $typePiece);
    }

    /**
     * Update the specified TypePiece in storage.
     */
    public function update($id, UpdateTypePieceRequest $request)
    {
        $typePiece = $this->typePieceRepository->find($id);

        if (empty($typePiece)) {
            Flash::error('Type Piece not found');

            return redirect(route('type-pieces.index'));
        }

        $typePiece = $this->typePieceRepository->update($request->all(), $id);

        Flash::success('Type Piece updated successfully.');

        return redirect(route('type-pieces.index'));
    }

    /**
     * Remove the specified TypePiece from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $typePiece = $this->typePieceRepository->find($id);

        if (empty($typePiece)) {
            Flash::error('Type Piece not found');

            return redirect(route('type-pieces.index'));
        }

        $this->typePieceRepository->delete($id);

        Flash::success('Type Piece deleted successfully.');

        return redirect(route('type-pieces.index'));
    }
}
