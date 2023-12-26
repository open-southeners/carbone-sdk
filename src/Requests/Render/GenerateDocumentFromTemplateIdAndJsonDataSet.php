<?php

namespace OpenSoutheners\CarboneSdk\Requests\Render;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Generate a document from a template ID, and a JSON data-set
 *
 * Documentation: https://carbone.io/api-reference.html#render-reports
 */
class GenerateDocumentFromTemplateIdAndJsonDataSet extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/render/{$this->templateId}";
    }

    /**
     * @param  string  $templateId Unique identifier of the template
     */
    public function __construct(
        protected string $templateId,
    ) {
    }
}
