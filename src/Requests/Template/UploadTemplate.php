<?php

namespace OpenSoutheners\CarboneSdk\Requests\Template;

use OpenSoutheners\CarboneSdk\Responses\Template\UploadTemplateResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

/**
 * Upload a template.
 *
 * Documentation: https://carbone.io/api-reference.html#add-templates
 */
class UploadTemplate extends Request implements HasBody
{
    use HasMultipartBody;

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
            'template' => new MultipartValue(name: 'template', value: $this->template),
        ];
    }

    /**
     * @param  resource|string|\Psr\Http\Message\StreamInterface  $template
     */
    public function __construct(
        private mixed $template
    ) {
        //
    }
}
