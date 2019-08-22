<?php

namespace Railroad\Maropost\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Railroad\Maropost\Services\ContactService;
use Railroad\Maropost\ValueObjects\ContactVO;

class RemoveContactFromLists implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var int[]
     */
    private $listIds;

    /**
     * @var ContactVO
     */
    public $contact;

    /**
     * RemoveContactFromLists constructor.
     *
     * @param array $listIds
     * @param ContactVO $contact
     */
    public function __construct(array $listIds, ContactVO $contact)
    {
        $this->contact = $contact;
        $this->listIds = $listIds;
    }

    /**
     * @param ContactService $contactService
     * @throws GuzzleException
     */
    public function handle(ContactService $contactService)
    {
        $contactService->removeContactFromLists($this->listIds, $this->contact);
    }
}