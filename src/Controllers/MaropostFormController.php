<?php

namespace Railroad\Maropost\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Railroad\Maropost\Requests\SyncContactRequest;
use Railroad\Maropost\Services\ContactService;

class MaropostFormController extends Controller
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
     * @return Response
     */
    public function syncContact(SyncContactRequest $request)
    {
        $contactVO = $request->toContactVO();

        $existingContact = $this->contactService->createOrUpdate($contactVO);

        if ($request->has('success_redirect')) {
            $response = redirect()->away($request->input('success_redirect'));
        } else {
            $response = redirect()->back();
        }

        return $response->with(['success' => true]);
    }
}
