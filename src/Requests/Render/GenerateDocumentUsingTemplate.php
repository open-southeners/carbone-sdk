<?php

namespace OpenSoutheners\CarboneSdk\Requests\Render;

use OpenSoutheners\CarboneSdk\Data\Render;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Generate a document from a template ID, and a JSON data-set
 *
 * Documentation: https://carbone.io/api-reference.html#render-reports
 */
class GenerateDocumentUsingTemplate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/render/{$this->templateId}";
    }

    protected function defaultBody(): array
    {
        return $this->data->toArray();
    }

    /**
     * @param  string  $templateId Unique identifier of the template
     */
    public function __construct(
        protected string $templateId,
        protected Render $data
    ) {
    }
}
