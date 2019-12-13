<?php

declare(strict_types=1);

namespace Enconte\AFIPWS\Models;

use Enconte\AFIPWS\Auth\Authentication;

abstract class Factura implements FacturaInterface
{
    public $service;

    public $ws;

    public $datos;

    public $resultado;

    use Validaciones;

    public function __construct(AfipConfig $afipConfig)
    {
        $this->service = new Authentication($afipConfig, $this->ws);
    }
}
