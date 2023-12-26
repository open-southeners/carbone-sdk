<?php

namespace OpenSoutheners\CarboneSdk;

use OpenSoutheners\CarboneSdk\Resource\Render;
use OpenSoutheners\CarboneSdk\Resource\Status;
use OpenSoutheners\CarboneSdk\Resource\Template;
use Saloon\Http\Auth\HeaderAuthenticator;
use Saloon\Http\Connector;

/**
 * Carbone API
 *
 * Carbone Cloud/On-premise Open API reference.
 *
 * For requesting:
 * - Carbone Cloud API: find your API key on your [Carbone account](https://account.carbone.io). Home page > Copy the `production` or `testing` API key.
 * - Carbone On-premise: Update the `Server URL` on the Open API specification.
 *
 * Useful links:
 * - [API Flow](https://carbone.io/api-reference.html#quickstart-api-flow)
 * - [Integration / SDKs](https://carbone.io/api-reference.html#api-integration)
 * - [Generated document storage](https://carbone.io/api-reference.html#report-storage)
 * - [Request timeout](https://carbone.io/api-reference.html#api-timeout)
 */
class Carbone extends Connector
{
    public function __construct(
        protected readonly string $token,
        protected readonly ?string $version = '4'
    ) {
        //
    }

    protected function defaultAuth(): HeaderAuthenticator
    {
        return new HeaderAuthenticator("Bearer {$this->token}");
    }

    protected function defaultHeaders(): array
    {
        return [
            'carbone-version' => $this->version,
        ];
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.carbone.io';
    }

    public function render(): Render
    {
        return new Render($this);
    }

    public function status(): Status
    {
        return new Status($this);
    }

    public function template(): Template
    {
        return new Template($this);
    }
}
