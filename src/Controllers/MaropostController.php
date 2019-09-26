<?php

namespace Railroad\Maropost\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Routing\Controller;
use Railroad\Maropost\Services\ContactService;
use Railroad\Maropost\ValueObjects\ContactVO;
use Symfony\Component\HttpFoundation\Request;

class MaropostController extends Controller
{
    /**
     * @var ContactService
     */
    private $contactService;

    /**
     * MaropostController constructor.
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @param Request $request
     * @param $email
     * @throws GuzzleException
     */
    public function syncContact(Request $request, $email)
    {
        $existingContact = $this->contactService->createOrUpdate(new ContactVO($email));
    }
}
