<?php

namespace Railroad\Maropost\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Railroad\Maropost\Services\ContactService;
use Railroad\Maropost\ValueObjects\ContactVO;

class AddTagsToContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var string[]
     */
    private $tagsName;

    /**
     * @var ContactVO
     */
    public $contact;

    /**
     * AddTagsToContact constructor.
     *
     * @param ContactVO $contact
     * @param array $tagsName
     */
    public function __construct(ContactVO $contact, array $tagsName)
    {
        $this->contact = $contact;
        $this->tagsName = $tagsName;
    }

    /**
     * @param ContactService $contactService
     * @throws GuzzleException
     */
    public function handle(ContactService $contactService)
    {
        $contactService->addTagsToContact($this->contact, $this->tagsName);
    }
}