<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCertificationProRequest;
use App\Http\Requests\UpdateCertificationProRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CertificationProRepository;
use Illuminate\Http\Request;
use Flash;

class CertificationProController extends AppBaseController
{
    /** @var CertificationProRepository $certificationProRepository*/
    private $certificationProRepository;

    public function __construct(CertificationProRepository $certificationProRepo)
    {
        $this->certificationProRepository = $certificationProRepo;
    }

    /**
     * Display a listing of the CertificationPro.
     */
    public function index(Request $request)
    {
        return view('certification_pros.index');
    }

    /**
     * Show the form for creating a new CertificationPro.
     */
    public function create()
    {
        return view('certification_pros.create');
    }

    /**
     * Store a newly created CertificationPro in storage.
     */
    public function store(CreateCertificationProRequest $request)
    {
        $input = $request->all();

        $certificationPro = $this->certificationProRepository->create($input);

        Flash::success('Certification Pro saved successfully.');

        return redirect(route('certification-pros.index'));
    }

    /**
     * Display the specified CertificationPro.
     */
    public function show($id)
    {
        $certificationPro = $this->certificationProRepository->find($id);

        if (empty($certificationPro)) {
            Flash::error('Certification Pro not found');

            return redirect(route('certification-pros.index'));
        }

        return view('certification_pros.show')->with('certificationPro', $certificationPro);
    }

    /**
     * Show the form for editing the specified CertificationPro.
     */
    public function edit($id)
    {
        $certificationPro = $this->certificationProRepository->find($id);

        if (empty($certificationPro)) {
            Flash::error('Certification Pro not found');

            return redirect(route('certification-prosss.index'));
        }

        return view('certification_pros.edit')->with('certificationPro', $certificationPro);
    }

    /**
     * Update the specified CertificationPro in storage.
     */
    public function update($id, UpdateCertificationProRequest $request)
    {
        $certificationPro = $this->certificationProRepository->find($id);

        if (empty($certificationPro)) {
            Flash::error('Certification Pro not found');

            return redirect(route('certification-pros.index'));
        }

        $certificationPro = $this->certificationProRepository->update($request->all(), $id);

        Flash::success('Certification Pro updated successfully.');

        return redirect(route('certification-pros.index'));
    }

    /**
     * Remove the specified CertificationPro from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $certificationPro = $this->certificationProRepository->find($id);

        if (empty($certificationPro)) {
            Flash::error('Certification Pro not found');

            return redirect(route('certification-pros.index'));
        }

        $this->certificationProRepository->delete($id);

        Flash::success('Certification Pro deleted successfully.');

        return redirect(route('certification-pros.index'));
    }
}
