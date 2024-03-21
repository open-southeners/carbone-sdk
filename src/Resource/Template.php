<?php

namespace OpenSoutheners\CarboneSdk\Resource;

use OpenSoutheners\CarboneSdk\Requests\Template\CheckTemplateExists;
use OpenSoutheners\CarboneSdk\Requests\Template\DeleteTemplateFromTemplateId;
use OpenSoutheners\CarboneSdk\Requests\Template\DownloadTemplateFromTemplateId;
use OpenSoutheners\CarboneSdk\Requests\Template\UploadTemplate;
use OpenSoutheners\CarboneSdk\Requests\Template\UploadTemplateAsBase64;
use OpenSoutheners\CarboneSdk\Responses\Template\DownloadTemplateResponse;
use OpenSoutheners\CarboneSdk\Responses\Template\UploadTemplateResponse;
use Saloon\Http\Response;

// TODO: PHPStan conflicting this class with PHP's built-in resource type
class Template extends \OpenSoutheners\CarboneSdk\Resource
{
    /**
     * @param  string  $templateId Unique identifier of the template
     */
    public function exists(string $templateId): Response
    {
        return $this->connector->send(new CheckTemplateExists($templateId));
    }

    /**
     * @param  resource|string|\Psr\Http\Message\StreamInterface  $template Path or stream of the file to upload as template
     */
    public function upload(mixed $template): UploadTemplateResponse
    {
        /** @var \OpenSoutheners\CarboneSdk\Responses\Template\UploadTemplateResponse $response */
        $response = $this->connector->send(new UploadTemplate($template));

        return $response;
    }

    /**
     * @param  string  $template Base64 content of the file to upload as template
     */
    public function base64Upload(string $template): UploadTemplateResponse
    {
        /** @var \OpenSoutheners\CarboneSdk\Responses\Template\UploadTemplateResponse $response */
        $response = $this->connector->send(new UploadTemplateAsBase64($template));

        return $response;
    }

    /**
     * @param  string  $templateId Unique identifier of the template
     */
    public function download(string $templateId): DownloadTemplateResponse
    {
        /** @var \OpenSoutheners\CarboneSdk\Responses\Template\DownloadTemplateResponse $response */
        $response = $this->connector->send(new DownloadTemplateFromTemplateId($templateId));

        return $response;
    }

    /**
     * @param  string  $templateId Unique identifier of the template
     */
    public function delete(string $templateId): Response
    {
        return $this->connector->send(new DeleteTemplateFromTemplateId($templateId));
    }
}
