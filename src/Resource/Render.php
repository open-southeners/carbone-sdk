<?php

namespace OpenSoutheners\CarboneSdk\Resource;

use OpenSoutheners\CarboneSdk\Data;
use OpenSoutheners\CarboneSdk\Requests\Render\GenerateDocumentUsingTemplate;
use OpenSoutheners\CarboneSdk\Requests\Render\RetrieveGeneratedDocument;
use OpenSoutheners\CarboneSdk\Resource;
use OpenSoutheners\CarboneSdk\Responses\Render\GenerateDocumentUsingTemplateResponse;
use Saloon\Http\Response;

class Render extends Resource
{
    /**
     * @param  string  $templateId Unique identifier of the template
     */
    public function generate(string $templateId, Data\Render $data): GenerateDocumentUsingTemplateResponse
    {
        /** @var \OpenSoutheners\CarboneSdk\Responses\Render\GenerateDocumentUsingTemplateResponse $response */
        $response = $this->connector->send(new GenerateDocumentUsingTemplate($templateId, $data));

        return $response;
    }

    /**
     * @param  string  $renderId Unique identifier of the report
     */
    public function retrieve(string $renderId): Response
    {
        return $this->connector->send(new RetrieveGeneratedDocument($renderId));
    }
}
