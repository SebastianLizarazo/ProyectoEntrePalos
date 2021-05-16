<?php

require ("..\app\Models\Facturas.php");
use App\Models\Facturas;

$arrFactura1 = [

    'Numero' => 1,
    'Fecha' => '2021-05-12',
    'IVA' => 0.19,
    'MedioPago' => 'Efectivo',
    'Mesero_id' => 1,
    'Estado' => 'Pendiente',
    'TipoPedido' => 'Mesa',

];
$arrFactura2 = [

    'Numero' => 2,
    'Fecha' => '2020-11-03',
    'IVA' => 0.19,
    'MedioPago' => 'Ahorro a la mano',
    'Mesero_id' => 3,
    'Estado' => 'Cancelada',
    'TipoPedido' => 'Domicilio',

];
$arrFactura3 = [

    'Numero' => 3,
    'Fecha' => '2019-07-23',
    'IVA' => 0.19,
    'MedioPago' => 'Daviplata',
    'Mesero_id' => 1,
    'Estado' => 'Paga',
    'TipoPedido' => 'Domicilio',

];
$arrFactura4 = [

    'Numero' => 4,
    'Fecha' => '2021-07-22',
    'IVA' => 0.19,
    'MedioPago' => 'Datafono',
    'Mesero_id' => 3,
    'Estado' => 'Paga',
    'TipoPedido' => 'Mesa',

];

$objFactura1= new Facturas($arrFactura1);
$objFactura1->insert();
//var_dump($objFactura1);
//$objFactura1->setMedioPago('Nequi');
//$objFactura1->setTipoPedido('Mesa');
//$objFactura1->update();

$objFactura2= new Facturas($arrFactura2);
$objFactura2->insert();
//var_dump($objFactura1);

$objFactura3 = new Facturas($arrFactura3);
$objFactura3->insert();
//var_dump($objFactura3);

$objFactura4= new Facturas($arrFactura4);
$objFactura4->insert();
//var_dump($objFactura4);