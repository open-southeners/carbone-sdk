<?php

namespace OpenSoutheners\CarboneSdk\Resource;

use OpenSoutheners\CarboneSdk\Requests\Render\GenerateDocumentFromTemplateIdAndJsonDataSet;
use OpenSoutheners\CarboneSdk\Requests\Render\RetreiveGeneratedDocumentFromRenderId;
use OpenSoutheners\CarboneSdk\Resource;
use Saloon\Http\Response;

class Render extends Resource
{
    /**
     * @param  string  $templateId Unique identifier of the template
     */
    public function generate(string $templateId): Response
    {
        return $this->connector->send(new GenerateDocumentFromTemplateIdAndJsonDataSet($templateId));
    }

    /**
     * @param  string  $renderId Unique identifier of the report
     */
    public function retreive(string $renderId): Response
    {
        return $this->connector->send(new RetreiveGeneratedDocumentFromRenderId($renderId));
    }
}
