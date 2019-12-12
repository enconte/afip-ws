<?php

declare(strict_types=1);

namespace enconte\afipws\Models;

use enconte\afipws\Auth\Authentication;

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
