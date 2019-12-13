<?php

declare(strict_types=1);

namespace Enconte\AFIPWS\Models;

interface FacturaInterface
{
    public function nuevaFactura();

    public function getCAE();

    public function requestCAE();

    public function getFactura();
}
