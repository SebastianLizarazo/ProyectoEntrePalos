<?php
//Este archivo es para hacer pruebas unitarias de la clase Oferta
require ("..\app\Models\Ofertas.php");//Importamos la clase Ofertas
use App\Models\Ofertas;

$arrConsumoTb1=[   //creamos un array ficticio
'Pago_id'=> 1,
'Producto_id'=> 3,
'CantidadProducto'=> 5,
'Descripcion'=> 'El trabajador consumio una botella de agua'
];

$arrConsumoTb2=[   //creamos un array ficticio
    'Pago_id'=> 2,
    'Producto_id'=> 2,
    'CantidadProducto'=> 2,
    'Descripcion'=> 'El trabajador consumio fritos y jugos'
];

$arrConsumoTb3=[   //creamos un array ficticio
    'Pago_id'=> 3,
    'Producto_id'=> 1,
    'CantidadProducto'=> 7,
    'Descripcion'=> 'El trabajador consumio un gaseosa 350 ml'
];

$objConsumoTb1= new \App\Models\ConsumoTrabajadores($arrConsumoTb1);
$objConsumoTb1->insert();
//var_dump($objConsumoTb1);

$objConsumoTb2= new \App\Models\ConsumoTrabajadores($arrConsumoTb2);
$objConsumoTb2->insert();
//var_dump($objConsumoTb2);

$objConsumoTb3= new \App\Models\ConsumoTrabajadores($arrConsumoTb3);
$objConsumoTb3->insert();
//var_dump($objConsumoTb3);

//Prueba update
//$pruebaUpdate = \App\Models\ConsumoTrabajadores::searchForId(1);//Buscamos la oferta que queremos modificar
//$pruebaUpdate->setPagoId(55000);
//$pruebaUpdate->setProductoId('Disponible');
//$pruebaUpdate->update();

//$pruebaOfertaRegist= \App\Models\ConsumoTrabajadores::consumotrabajadorRegistrada(7, 'El trabajador consumio un gaseosa 350 ml');// Comprobamos que ya exista una oferta con esas caracteristicas
//var_dump($pruebaOfertaRegist);

//$pruebaSearch1Consum= Ofertas::search("SELECT * FROM consumotrabajador WHERE Descripcion = 'El trabajador consumio'");// Prueba metodo search
///* @var $pruebaSearch1Consum \App\Models\ConsumoTrabajadores[] */
//foreach ($pruebaSearch1Consum as $consumotb)
//{
//   print_r($consumotb->jsonSerialize());
//}

//$pruebaSearch2Consum= \App\Models\ConsumoTrabajadores::searchForId(3);// Prueba metodo searchForId
//var_dump($pruebaSearch2Consum);
//print_r($pruebaSearch2Consum->jsonSerialize());

//$consumotbGetAll= \App\Models\ConsumoTrabajadores::getAll();// Prueba metodo getAll
//var_dump($consumotbGetAll);
// /* @var $consumotbGetAll \App\Models\ConsumoTrabajadores::[] */
//foreach ($consumotbGetAll as $consumotb)
//{
//   print_r($consumotb->jsonSerialize());
//}
