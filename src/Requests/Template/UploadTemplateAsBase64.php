<?php

namespace OpenSoutheners\CarboneSdk\Requests\Template;

use OpenSoutheners\CarboneSdk\Responses\Template\UploadTemplateResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Upload a template.
 *
 * Documentation: https://carbone.io/api-reference.html#add-templates
 */
class UploadTemplateAsBase64 extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected ?string $response = UploadTemplateResponse::class;

    public function resolveEndpoint(): string
    {
        return '/template';
    }

    /**
     * Default body
     *
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return [
            'template' => $this->template,
        ];
    }

    public function __construct(
        private string $template
    ) {
        // 
    }
}
