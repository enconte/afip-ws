<?php

declare(strict_types=1);

namespace enconte\afipws\Models;

class AfipConfig
{
    /* @var bool */
    public $sandbox;

    /* @var string */
    public $cuit;

    /* @var string */
    public $xml_generated_directory;

    /* @var string */
    public $certificate_path;

    /* @var string */
    public $privatekey_path;

    public function setSandbox(bool $value = null): void
    {
        $this->sandbox = $value ?? false;
    }

    public function setCuit(string $cuit): void
    {
        $this->cuit = $cuit;
    }

    public function setXmlFolder(string $xml_directory): void
    {
        $this->xml_generated_directory = $xml_directory;
    }

    public function setCertificateFilename(string $certificate_path): void
    {
        $this->certificate_path = $certificate_path;
    }

    public function setPrivateKeyFilename(string $privatekey_path): void
    {
        $this->privatekey_path = $privatekey_path;
    }
}
