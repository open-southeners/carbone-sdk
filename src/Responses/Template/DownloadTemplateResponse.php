<?php

namespace OpenSoutheners\CarboneSdk\Responses\Template;

use Saloon\Http\Response;

class DownloadTemplateResponse extends Response
{
    /**
     * Get file name from Carbone returned download (from headers).
     */
    public function getFileName(): ?string
    {
        /** @var string|null $contentDisposition */
        $contentDisposition = $this->header('content-disposition');

        if (! $contentDisposition) {
            return null;
        }

        return str_replace('"', '', str_replace('filename=', '', $contentDisposition));
    }

    /**
     * Get extension from file name.
     */
    public function getFileExtension(): ?string
    {
        /** @var string|null $templateFileName */
        $templateFileName = $this->getFileName();

        if (! $templateFileName) {
            return null;
        }

        $fileNameParts = explode('.', $templateFileName);

        return $fileNameParts[count($fileNameParts)-1];
    }

    /**
     * Get mime type from file name.
     */
    public function getFileMimeType(): ?string
    {
        /** @var string|null $contentType */
        $contentType = $this->header('content-type');

        if (! $contentType) {
            return null;
        }

        return $contentType;
    }
}
