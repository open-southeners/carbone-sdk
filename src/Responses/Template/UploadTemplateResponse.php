<?php

namespace OpenSoutheners\CarboneSdk\Responses\Template;

use Saloon\Http\Response;

class UploadTemplateResponse extends Response
{
    public function getTemplateId(): ?string
    {
        /** @var string|null $templateId */
        $templateId = $this->json('data.templateId');

        if (! $templateId) {
            return null;
        }

        return $templateId;
    }
}
