<?php

namespace App\Http\Controllers;

use App\Models\QuickService;
use App\Repositories\QuickServiceRepository;
use Illuminate\Http\Request;

class CreateQuickService extends Controller
{
    private QuickServiceRepository $quickServiceRepository;

    public function __construct(QuickServiceRepository $quickServiceRepo)
    {
        $this->quickServiceRepository = $quickServiceRepo;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $input = $request->all();
        $user = auth('api')->users;
        $input ["user_id"] = $user->id;

        $request->validate(QuickService::$rules);

        $quickService = $this->quickServiceRepository->create($input);

        return $this->sendResponse($quickService->toArray(), 'Quick Service saved successfully');

    }
}
