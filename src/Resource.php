<?php

namespace OpenSoutheners\CarboneSdk;

use Saloon\Http\Connector;

class Resource
{
    public function __construct(
        protected Connector $connector,
    ) {
    }
}
