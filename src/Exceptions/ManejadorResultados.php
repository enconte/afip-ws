<?php

declare(strict_types=1);

namespace Enconte\AFIPWS\Exceptions;

/**
 * Class ManejadorResultados.
 */
class ManejadorResultados
{
    /**
     * Recupera información de eventos.
     *
     * @param \stdClass $resultado
     *
     * @return \stdClass con eventos o null si no existen
     */
    public function obtenerEventos($resultado): \stdClass
    {
        return $resultado->Events ?? $resultado->evento ?? null;
    }

    /**
     * Recupera detalle de observaciones del comprobante.
     *
     * @param \stdClass $path
     * @param string $name
     *
     * @return array|null con observaciones o null si no existen
     */
    public function obtenerObservaciones($path, $name): ?array
    {
        return $path->{$name} ?? null;
    }

    /**
     * Recupera información de errores detectados lanzandolo en una excepción.
     *
     * @throws WsException
     */
    public function procesar($resultado): void
    {
        if (isset($resultado->Errors)) {
            $errores = reset($resultado->Errors)->Msg;
        } else {
            //Porque el error viene de otra forma si existe message
            if (!property_exists($resultado, 'message')) {
                $errores = isset($resultado->arrayErrores) ?
                    (isset($resultado->arrayErrores->codigoDescripcion) ?
                        $resultado->arrayErrores->codigoDescripcion->descripcion
                        : $resultado->arrayErrores)
                    : null;
            } else {
                $errores = $resultado->getMessage();
            }
        }

        if (!empty($errores)) {
            throw new WsException($errores);
        }
    }
}
