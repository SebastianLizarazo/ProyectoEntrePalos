<?php

require ("..\app\Models\DetallePedidos.php");
use App\Models\DetallePedidos;
use App\Models\Mesas;
use App\Models\Ofertas;
use App\Models\Productos;
use App\Models\Facturas;


$arrDetallePedidos1= [

        'Factura_id' => 1,
        'Producto_id' => 2,
        'Ofertas_id' => 1,
        'CantidadProducto' => 4,
        'CantidadOferta' => 7,
        'Mesa_id' => 1,
];
$arrDetallePedidos2= [

        'Factura_id' => 1,
        'Producto_id' => 1,
        'Ofertas_id' => 2,
        'CantidadProducto' =>5,
        'CantidadOferta' => 2,
        'Mesa_id' => 2,
];
$arrDetallePedidos3= [

        'Factura_id' => 4,
        'Producto_id' => 3,
        'Ofertas_id' => 3,
        'CantidadProducto' => 0,
        'CantidadOferta' => 5,
        'Mesa_id' => 1,
];

$arrDetallePedidos4= [

        'Factura_id' => 2,
        'Producto_id' => 3,
        'Ofertas_id' => 1,
        'CantidadProducto' => 7,
        'CantidadOferta' => 0,
        'Mesa_id' => null,
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
//$pruebaUpdate = DetallePedidos::searchForId(4);
//$pruebaUpdate->setCantidadProducto(19);
//$pruebaUpdate->setFacturaId(3);
//$pruebaUpdate->setOfertasId(3);
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

//Prueba relaciones Detalle Pedido

// Prueba relacion detalle pedido con mesas
//$pruebMesa = Mesas::searchForId(1);
//print_r($pruebMesa->getDetallesPedidoMesa());

//$pruebDetPed = DetallePedidos::searchForId(2);
//print_r($pruebDetPed->getMesa());

// Prueba relacion detalle pedido oferta
//$pruebOfer = Ofertas::searchForId(1);
//print_r($pruebOfer->getDetallePedidoOferta());

//$pruebDetPedOf = DetallePedidos::searchForId(4);
//echo "El detalle pedido numero ".$pruebDetPedOf->getId()." contiene la oferta ".$pruebDetPedOf->getOferta()->getNombre();
//print_r($pruebDetPedOf->getOferta());

//Prueba relacion entre detalle pedido y producto
//$pruebProd = Productos::searchForId(3);
//print_r($pruebProd->getDetallePedidoProductos());

//$pruebDetPedProd = DetallePedidos::searchForId(2);
//print_r($pruebDetPedProd->getProducto());

//Prueba relacion entre detalle pedido y factura
//$pruebFac = Facturas::searchForId(1);
//print_r($pruebFac->getDetallePedidoFactura());

//$pruebDetPedFac = DetallePedidos::searchForId(3);
//print_r($pruebDetPedFac->getFactura());