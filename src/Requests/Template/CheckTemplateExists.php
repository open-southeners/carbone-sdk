<?php

namespace OpenSoutheners\CarboneSdk\Requests\Template;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class CheckTemplateExists extends Request
{
    protected Method $method = Method::HEAD;

    public function resolveEndpoint(): string
    {
        return "/template/{$this->templateId}";
    }

    /**
     * @param  string  $templateId Unique identifier of the template
     */
    public function __construct(
        protected string $templateId,
    ) {
    }
}
