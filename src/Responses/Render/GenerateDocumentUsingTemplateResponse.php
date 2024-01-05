<?php

namespace OpenSoutheners\CarboneSdk\Responses\Render;

use Saloon\Http\Response;

class GenerateDocumentUsingTemplateResponse extends Response
{
    public function getRenderId(): ?string
    {
        /** @var string|null $renderId */
        $renderId = $this->json('data.renderId');

        if (! $renderId) {
            return null;
        }

        return $renderId;
    }
}
