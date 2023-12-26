<?php

namespace OpenSoutheners\CarboneSdk\Requests\Render;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Retreive a generated document from a render ID.
 *
 * Documentation: https://carbone.io/api-reference.html#download-rendered-reports
 */
class RetrieveGeneratedDocument extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/render/{$this->renderId}";
    }

    /**
     * @param  string  $renderId Unique identifier of the report
     */
    public function __construct(
        protected string $renderId,
    ) {
    }
}
