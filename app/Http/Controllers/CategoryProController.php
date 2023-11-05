<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryProRequest;
use App\Http\Requests\UpdateCategoryProRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CategoryProRepository;
use Illuminate\Http\Request;
use Flash;

class CategoryProController extends AppBaseController
{
    /** @var CategoryProRepository $categoryProRepository*/
    private $categoryProRepository;

    public function __construct(CategoryProRepository $categoryProRepo)
    {
        $this->categoryProRepository = $categoryProRepo;
    }

    /**
     * Display a listing of the CategoryPro.
     */
    public function index(Request $request)
    {
        return view('category_pros.index');
    }

    /**
     * Show the form for creating a new CategoryPro.
     */
    public function create()
    {
        return view('category_pros.create');
    }

    /**
     * Store a newly created CategoryPro in storage.
     */
    public function store(CreateCategoryProRequest $request)
    {
        $input = $request->all();

        $categoryPro = $this->categoryProRepository->create($input);

        Flash::success('Category Pro saved successfully.');

        return redirect(route('category-pros.index'));
    }

    /**
     * Display the specified CategoryPro.
     */
    public function show($id)
    {
        $categoryPro = $this->categoryProRepository->find($id);

        if (empty($categoryPro)) {
            Flash::error('Category Pro not found');

            return redirect(route('category-pros.index'));
        }

        return view('category_pros.show')->with('categoryPro', $categoryPro);
    }

    /**
     * Show the form for editing the specified CategoryPro.
     */
    public function edit($id)
    {
        $categoryPro = $this->categoryProRepository->find($id);

        if (empty($categoryPro)) {
            Flash::error('Category Pro not found');

            return redirect(route('category-prosss.index'));
        }

        return view('category_pros.edit')->with('categoryPro', $categoryPro);
    }

    /**
     * Update the specified CategoryPro in storage.
     */
    public function update($id, UpdateCategoryProRequest $request)
    {
        $categoryPro = $this->categoryProRepository->find($id);

        if (empty($categoryPro)) {
            Flash::error('Category Pro not found');

            return redirect(route('category-pros.index'));
        }

        $categoryPro = $this->categoryProRepository->update($request->all(), $id);

        Flash::success('Category Pro updated successfully.');

        return redirect(route('category-pros.index'));
    }

    /**
     * Remove the specified CategoryPro from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categoryPro = $this->categoryProRepository->find($id);

        if (empty($categoryPro)) {
            Flash::error('Category Pro not found');

            return redirect(route('category-pros.index'));
        }

        $this->categoryProRepository->delete($id);

        Flash::success('Category Pro deleted successfully.');

        return redirect(route('category-pros.index'));
    }
}
