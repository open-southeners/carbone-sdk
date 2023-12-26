<?php

namespace OpenSoutheners\CarboneSdk\Requests\Status;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Fetch the API status and version
 */
class FetchTheApiStatusAndVersion extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/status';
    }

    public function __construct()
    {
    }
}
