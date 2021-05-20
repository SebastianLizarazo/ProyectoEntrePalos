<?php

require ("..\app\Models\DetalleOfertas.php");
use App\Models\DetalleOfertas;

$arrDetOferta1 = [
    'Producto_id'=> 1,
    'Oferta_id'=> 3,
    'CantidadProducto'=> 2,
];
$arrDetOferta2 = [
    'Producto_id'=> 2,
    'Oferta_id'=> 2,
    'CantidadProducto'=> 3,
];
$arrDetOferta3 = [
    'Producto_id'=> 3,
    'Oferta_id'=> 1,
    'CantidadProducto'=> 15,

];

//$objDetOferta1= new DetalleOfertas($arrDetOferta1);
//$objDetOferta1->insert();
//var_dump($objDetOferta1);

//$objDetOferta2= new DetalleOfertas($arrDetOferta2);
//$objDetOferta2->insert();
//var_dump($objDetOferta2);

//$objDetOferta3= new DetalleOfertas($arrDetOferta3);
//$objDetOferta3->insert();
//var_dump($objDetOferta3);

//Prueba update
//$pruebaUpdate = DetalleOfertas::searchForId(1);//Buscamos el detalle pedido que queremos modificar
//$pruebaUpdate->setProductoId(3);
//$pruebaUpdate->setOfertaId(2);
//$pruebaUpdate->update();

//$pruebaDetaOfertaRegist= DetalleOfertas::detalleOfertaRegistrada(2,2);// Comprobamos que ya exista una oferta con esas caracteristicas
//var_dump($pruebaOfertaRegist);


//$pruebaSearch1DetOfert= DetalleOfertas::search("SELECT * FROM detalleoferta WHERE CantidadProducto = 2");// Prueba metodo search
///* @var $pruebaSearch1DetOfert App\Models\Ofertas[] */
//foreach ($pruebaSearch1DetOfert as $detalleoferta)
//{
//  print_r($detalleoferta->jsonSerialize());
//}

//$pruebaSearch2DetOfert= DetalleOfertas::searchForId(3);// Prueba metodo searchForId
//var_dump($pruebaSearch2DetOfert);
//print_r($pruebaSearch2DetOfert->jsonSerialize());

//$detofertaGetAll= DetalleOfertas::getAll();// Prueba metodo getAll
//var_dump($detofertaGetAll);
//* @var $detofertaGetAll App\Models\DetalleOfertas[] */
//foreach ($detofertaGetAll as $detalloferta)
//{
//  print_r($detalloferta->jsonSerialize());
//}

