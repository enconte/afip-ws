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

    /** @var \Illuminate\Contracts\Config\Repository  */
    protected $config;


    /**
     * @param AFIPWS $afipws
     */
    public function __construct(WSFE $wsfe, ConfigRepository $config){
        $this->wsfe = $wsfe;
        $this->config = $config;
    }

    /**
     * Get the AFIPWS instance
     *
     * @return AFIPWS
     */
    public function getAFIPWS(){
        return $this->afipws;
    }

    /**
     * Get the AFIPWS instance
     *
     * @return AFIPWS
     */
    public function crearFactura($data){
        return $this->afipws;
    }

    

}
