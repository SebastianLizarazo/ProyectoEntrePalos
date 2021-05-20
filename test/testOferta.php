<?php

require ("..\app\Models\Ofertas.php");
use App\Models\Ofertas;

$arrOferta1 = [
    'Nombre'=> 'Mega combo',
    'Descripcion'=> 'Llego para ser uno de las mejores combos',
    'PrecioUnidadVentaOferta'=> 50000,
    'Estado'=> 'No disponible'
];
$arrOferta2 = [
    'Nombre'=> 'Combo EntreHamburg',
    'Descripcion'=> 'La especialidad de la casa, en este combo',
    'PrecioUnidadVentaOferta'=> 35000,
    'Estado'=> 'Disponible'
];
$arrOferta3 = [
    'Nombre'=> 'Six Pack',
    'Descripcion'=> 'Suave',
    'PrecioUnidadVentaOferta'=> 20000,
    'Estado'=> 'Disponible'
];

$objOferta1= new Ofertas($arrOferta1);
$objOferta1->insert();
//var_dump($objOferta1);

$objOferta2= new Ofertas($arrOferta2);
$objOferta2->insert();
//var_dump($objOferta2);

$objOferta3= new Ofertas($arrOferta3);
$objOferta3->insert();
//var_dump($objOferta3);

//Prueba update
//$pruebaUpdate = Ofertas::searchForId(1);//Buscamos la oferta que queremos modificar
//$pruebaUpdate->setPrecioUnidadVentaOferta(55000);
//$pruebaUpdate->setEstado('Disponible');
//$pruebaUpdate->update();

//$pruebaOfertaRegist= Ofertas::ofertaRegistrada('Mega combo','Llego para ser uno de las mejores combos');// Comprobamos que ya exista una oferta con esas caracteristicas
//var_dump($pruebaOfertaRegist);


//$pruebaSearch1Ofert= Ofertas::search("SELECT * FROM oferta WHERE Estado = 'Disponible'");// Prueba metodo search
///* @var $pruebaSearch1Ofert App\Models\Ofertas[] */
//foreach ($pruebaSearch1Ofert as $oferta)
//{
 //   print_r($oferta->jsonSerialize());
//}

//$pruebaSearch2Ofert= Ofertas::searchForId(3);// Prueba metodo searchForId
//var_dump($pruebaSearch2Ofert);
//print_r($pruebaSearch2Ofert->jsonSerialize());

//$ofertaGetAll= Ofertas::getAll();// Prueba metodo getAll
//var_dump($ofertaGetAll);
//* @var $ofertaGetAll App\Models\Ofertas[] */
//foreach ($ofertaGetAll as $oferta)
//{
//   print_r($oferta->jsonSerialize());
//}

