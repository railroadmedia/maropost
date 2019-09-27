<?php

namespace Railroad\Maropost\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Railroad\Maropost\Requests\SyncContactRequest;
use Railroad\Maropost\Services\ContactService;

class MaropostJsonController extends Controller
{
    /**
     * @var ContactService
     */
    private $contactService;

    /**
     * MaropostController constructor.
     *
     * @param  ContactService  $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @param  SyncContactRequest  $request
     *
     * @throws GuzzleException
     *
     * @return JsonResponse
     */
    public function syncContact(SyncContactRequest $request)
    {
        $contactVO = $request->toContactVO();

        $existingContact = $this->contactService->createOrUpdate($contactVO);

        return response()->json(['success' => true]);
    }
}
