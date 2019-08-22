<?php

namespace Railroad\Maropost\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Railroad\Maropost\Services\ContactService;
use Railroad\Maropost\ValueObjects\ContactVO;

class SyncContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var ContactVO
     */
    public $contact;

    /**
     * SyncContact constructor.
     *
     * @param ContactVO $contact
     */
    public function __construct(ContactVO $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @param ContactService $contactService
     * @throws GuzzleException
     */
    public function handle(ContactService $contactService)
    {
        $contactService->createOrUpdate($this->contact);
    }
}