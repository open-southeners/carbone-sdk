<?php

namespace OpenSoutheners\CarboneSdk\Requests\Template;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a template from a template ID
 *
 * Documentation: https://carbone.io/api-reference.html#delete-templates
 */
class DeleteTemplateFromTemplateId extends Request
{
    protected Method $method = Method::DELETE;

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
