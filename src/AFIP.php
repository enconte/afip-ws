<?php
namespace Enconte\AFIPWS;

use Exception;
use Enconte\AFIPWS\WSFE\Wsfe;
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

    /**
     * @param wsfe $wsfe
     */
    public function __construct(WSFE $wsfe){
        $this->wsfe = $wsfe;
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
