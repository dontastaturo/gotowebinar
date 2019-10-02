<?php

namespace Slakbal\Gotowebinar\Resources\Attendee;

use Slakbal\Gotowebinar\Resources\AbstractResource;
use Slakbal\Gotowebinar\Resources\Traits\PagingQueryParameters;

final class Attendee extends AbstractResource
{
    use PagingQueryParameters, AttendeeOperations;

    /** RESOURCE PATH **/
    protected $baseResourcePath = '/organizers/:organizerKey/webinars/:webinarKey/attendees';

    public function __construct()
    {
        $this->resourcePath = $this->baseResourcePath;
    }
}
