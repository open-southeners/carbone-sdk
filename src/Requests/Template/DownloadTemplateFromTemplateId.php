<?php

namespace OpenSoutheners\CarboneSdk\Requests\Template;

use OpenSoutheners\CarboneSdk\Responses\Template\DownloadTemplateResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Download a template from a template ID
 *
 * Documentation: https://carbone.io/api-reference.html#get-templates
 */
class DownloadTemplateFromTemplateId extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = DownloadTemplateResponse::class;

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
