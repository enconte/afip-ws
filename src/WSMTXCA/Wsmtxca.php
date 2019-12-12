<?php

declare(strict_types=1);

namespace enconte\afipws\WSMTXCA;

use enconte\afipws\Exceptions\ManejadorResultados;
use enconte\afipws\Exceptions\WsException;
use enconte\afipws\Models\AfipConfig;
use enconte\afipws\Models\Invoice;

/**
 * Class Wsmtxca (Invoice with items).
 */
class Wsmtxca extends Invoice
{
    use WsmtxcaFuncionesInternas;

    public function __construct(AfipConfig $afipConfig)
    {
        $this->ws = 'wsmtxca';
        $this->resultado = new ManejadorResultados();

        parent::__construct($afipConfig);
    }

    /**
     * Permite crear un comprobante con items.
     *
     * @throws WsException
     */
    public function createInvoice()
    {
        $this->validateDataInvoice();

        try {
            $ultimoComprobante = $this->wsConsultarUltimoComprobanteAutorizado(
                $this->datos->codigoComprobante,
                $this->datos->puntoVenta
            );
        } catch (WsException $e) {
            $codigo = json_decode($e->getMessage())->codigo;
            if ($codigo != 1502) {
                throw new WsException($e->getMessage());
            }
            $ultimoComprobante = 0;
        }
        $this->datos = $this->parseFacturaArray($this->datos);
        $this->datos->numeroComprobante = $ultimoComprobante + 1;

        return $this->wsAutorizarComprobante($this->datos);
    }

    /**
     * Permite consultar  la  información  correspondiente  a  un  CAE  previamente  otorgado.
     *
     * @throws WsException
     * @throws \enconte\afipws\Exceptions\ValidationException
     */
    public function getCAE()
    {
        $this->validarDatos($this->datos, $this->getRules('fe'));

        return $this->wsConsultarCAE($this->datos);
    }

    /**
     * Permite solicitar Código de Autorización Electrónico (CAE).
     *
     * @throws WsException
     */
    public function requestCAE()
    {
        return $this->wsSolicitarCAE($this->datos);
    }

    /**
     * Permite consultar  la  información  correspondiente  a  un  CAEA  previamente  otorgado entre un rango de fechas.
     *
     * @throws WsException
     * @throws \enconte\afipws\Exceptions\ValidationException
     */
    public function consultarCAEAEntreFechas()
    {
        $this->validarDatos($this->datos, $this->getRules('fe'));
        $result = $this->wsConsultarCAEAEntreFechas($this->datos);

        return isset($result->CAEAResponse) ? $result->CAEAResponse : null;
    }

    /**
     * Permite consultar un comprobante con items ya emitido.
     *
     * @throws WsException
     * @throws \enconte\afipws\Exceptions\ValidationException
     */
    public function getInvoice()
    {
        $this->validarDatos($this->datos, $this->getRules('fe'));

        return $this->wsConsultarComprobante($this->datos);
    }
}
