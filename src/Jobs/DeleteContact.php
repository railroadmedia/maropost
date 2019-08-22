<?php

namespace Railroad\Maropost\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Railroad\Maropost\Services\ContactService;

class DeleteContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var string
     */
    public $email;

    /**
     * DeleteContact constructor.
     *
     * @param $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @param ContactService $contactService
     */
    public function handle(ContactService $contactService)
    {
        $contactService->deleteContactByEmail($this->email);
    }
}