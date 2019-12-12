<?php
/**
 * Copyright (C) 2019-2020 enconte <enconte@hotmail.com>.
 *
 * This file is part of afip-ws. afip-ws can not be copied and/or
 * distributed without the express permission of enconte
 */

declare(strict_types=1);

return [

    'wsaaWsdl' => __DIR__ . '/../src/WSAA/wsaa.wsdl',
    
    'xml_generados' => null,

    'passPhrase' => null,

    'proxyHost' => '190.122.183.81',

    'proxyPort' => '80',

    'url' => [
        'wsaa' => 'https://wsaahomo.afip.gov.ar/ws/services/LoginCms',
        'wsfe' => 'http://wswhomo.afip.gov.ar/wsfev1/service.asmx',
        'wsmtxca' => 'https://fwshomo.afip.gov.ar/wsmtxca/services/MTXCAService',
        'wspn3' => 'https://awshomo.afip.gov.ar/padron-puc-ws/services/select.ContribuyenteNivel3SelectServiceImpl',
        'padron-puc-ws-consulta-nivel4' => 'https://awshomo.afip.gov.ar/padron-puc-ws/services/select.ContribuyenteNivel4SelectServiceImpl',
    ],
    'url_production' => [
        'wsaa' => 'https://wsaa.afip.gov.ar/ws/services/LoginCms',
        'wsfe' => 'https://servicios1.afip.gov.ar/wsfev1/service.asmx',
        'wsmtxca' => 'https://serviciosjava.afip.gob.ar/wsmtxca/services/MTXCAService',
        'wspn3' => 'https://aws.afip.gov.ar/padron-puc-ws/services/select.ContribuyenteNivel3SelectServiceImpl',
    ],

];
