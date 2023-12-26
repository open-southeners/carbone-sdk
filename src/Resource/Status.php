<?php

namespace OpenSoutheners\CarboneSdk\Resource;

use OpenSoutheners\CarboneSdk\Requests\Status\FetchTheApiStatusAndVersion;
use OpenSoutheners\CarboneSdk\Resource;
use Saloon\Http\Response;

class Status extends Resource
{
    public function fetch(): Response
    {
        return $this->connector->send(new FetchTheApiStatusAndVersion());
    }
}
