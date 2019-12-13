<?php
namespace enconte\afipws;

use Exception;
use enconte\afipws\WSFE\Wsfe;
use enconte\afipws\Models\Factura;
use Illuminate\Http\Response;

/**
 * A Laravel package for AFIPWS
 *
 * @package afipws
 * @author Eduardo Conte
 */
class AFIP{

    /** @var WSFE  */
    protected $wsfe;

    /** @var Factrura  */
    protected $factura;


    /**
     * @param wsfe $wsfe
     */
    public function __construct(WSFE $wsfe, Factura $factura){
        $this->wsfe = $wsfe;
        $this->factura = $factura;
    }

    /**
     * Crear una factura
     *
     * @return 
     */
    public function crearFactura(array $data){
        return $this->wsfe->conectar();
    }

    

}
