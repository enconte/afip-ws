<?php

declare(strict_types=1);

namespace enconte\afipws\Models;

class GeneralHelper
{
    public function getAliasWsName(string $ws): string
    {
        switch ($ws) {
            case 'padron-puc-ws-consulta-nivel3':
                $alias = 'wspn3';
                break;
            default:
                $alias = $ws;
        }

        return $alias;
    }

    public static function getOriginalWsName(string $ws): string
    {
        switch ($ws) {
            case 'wspn3':
                $original = 'padron-puc-ws-consulta-nivel3';
                break;
            default:
                $original = $ws;
        }

        return $original;
    }
}
