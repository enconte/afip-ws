<?php

declare(strict_types=1);

namespace enconte\afipws\Models;

class CSRFile
{
    protected $business_name;

    protected $business_cuit;

    protected $privatekey_path;

    protected $app_name;

    public function __construct(
        string $business_name,
        int $business_cuit,
        string $privatekey_path,
        string $app_name = 'Enconte library'
    ) {
        $this->business_name = $business_name;
        $this->business_cuit = $business_cuit;
        $this->privatekey_path = $privatekey_path;
        $this->app_name = $app_name;
    }

    public function saveFileContent(): string
    {
        $name = str_replace(' ', '_', $this->business_name);
        $csrName = time() . '_CSR_' . $name;
        $csrTemp_file = tempnam(sys_get_temp_dir(), $csrName);

        $companyData = '/C=AR/O=' . $this->business_name . '/CN=' . $this->app_name . '/serialNumber=CUIT '
            . $this->business_cuit;
        $command = 'openssl req -new -key ' . $this->privatekey_path . ' -subj "' . $companyData . '" -out ' . $csrTemp_file;

        exec($command);

        return $csrTemp_file;
    }
}
