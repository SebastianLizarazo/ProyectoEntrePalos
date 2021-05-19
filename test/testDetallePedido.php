<?php

require ("..\app\Models\DetallePedidos.php");
use App\Models\DetallePedidos;

$arrDetallePedidos1= [

        'Factura_id' => ,
        'Producto_id' => ,
        'Ofertas_id' => ,
        'CantidadProducto' => ,
        'CantidadOferta' => ,
        'Mesa_id' => ,
];
$arrDetallePedidos2= [

        'Factura_id' => ,
        'Producto_id' => ,
        'Ofertas_id' => ,
        'CantidadProducto' => ,
        'CantidadOferta' => ,
        'Mesa_id' => ,
];
$arrDetallePedidos3= [

        'Factura_id' => ,
        'Producto_id' => ,
        'Ofertas_id' => ,
        'CantidadProducto' => ,
        'CantidadOferta' => ,
        'Mesa_id' => ,
];

$arrDetallePedidos4= [

        'Factura_id' => ,
        'Producto_id' => ,
        'Ofertas_id' => ,
        'CantidadProducto' => ,
        'CantidadOferta' => ,
        'Mesa_id' => ,
];

// Prueba insert
$DetallePedido1 = new DetallePedidos($arrDetallePedidos1);
$DetallePedido1->insert();

$DetallePedido2 = new DetallePedidos($arrDetallePedidos2);
$DetallePedido2->insert();

$DetallePedido3 = new DetallePedidos($arrDetallePedidos3);
$DetallePedido3->insert();

$DetallePedido4 = new DetallePedidos($arrDetallePedidos4);
$DetallePedido4->insert();

// Prueba update
//$pruebaUpdate = DetallePedidos::searchForId(3);
//$pruebaUpdate->setCantidadProducto();
//$pruebaUpdate->setFacturaId();
//$pruebaUpdate->setOfertasId();
//$pruebaUpdate->update();

// Prueba detalle pedido registrado
//$pruebaDetPedRegis= DetallePedidos::detallePedidoRegistrado(4,3);
//var_dump($pruebaDetPedRegis);

// Prueba search
//$pruebaSearch = DetallePedidos::search("SELECT * FROM detallepedido WHERE CantidadProducto > 4");
///* @var $pruebaSearch App\Models\DetallePedidos[] */
//foreach ($pruebaSearch as $detallePedido)
//{
//    print_r($detallePedido->jsonSerialize());
//}

// Prueba getAll
//$pruebaGetAll= DetallePedidos::getAll();
///* @var  $pruebaGetAll App\Models\DetallePedidos[] */
//foreach ($pruebaGetAll as $detallePedido)
//{
//    print_r($detallePedido->jsonSerialize());
//}


