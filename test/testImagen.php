<?php

require ('../app/Models/Imagenes.php');
use App\Models\Imagenes;

$arrImage1 = [

    'Nombre' => 'Imagen Hamburguesa 1',
    'Descripcion' => 'Foto simple del producto hamburguesa doble',
    'Ruta' => 'c:proyecto\imagenes\imagen1.png',
    'Estado' => 'Activo',
    'Producto_id' => 0,
    'Oferta_id' => 0,

];$arrImage2 = [

    'Nombre' => 'Imagen Hamburguesa 2',
    'Descripcion' => 'Foto simple del producto hamburguesa triple',
    'Ruta' => 'c:proyecto\imagenes\imagen2.png',
    'Estado' => 'Activo',
    'Producto_id' => 0,
    'Oferta_id' => 0,

];$arrImage3 = [

    'Nombre' => 'Imagen Alitas BBQ 1',
    'Descripcion' => 'Foto simple del producto alitas BBQ medianas',
    'Ruta' => 'c:proyecto\imagenes\imagen3.png',
    'Estado' => 'Activo',
    'Producto_id' => 0,
    'Oferta_id' => 0,

];$arrImage4 = [

    'Nombre' => 'Imagen Gaseosa Coca Cola',
    'Descripcion' => 'Foto de la gaseosa Coca Cola en baso de vidrio',
    'Ruta' => 'c:proyecto\imagenes\imagen4.png',
    'Estado' => 'Inactivo',
    'Producto_id' => 0,
    'Oferta_id' => 0,

];

// Prueba insert
//$imagen1= new Imagenes($arrImage1);
//var_dump($imagen1);
//$imagen1->insert();

//$imagen2= new Imagenes($arrImage2);
//var_dump($imagen2);
//$imagen2->insert();

//$imagen3= new Imagenes($arrImage3);
//var_dump($imagen3);
//$imagen3->insert();

//$imagen4= new Imagenes($arrImage4);
//var_dump($imagen1);
//$imagen4->insert();

// Prueba update
//$pruebaUpdate = Imagenes::searchForId(2);
//$pruebaUpdate->setNombre('BBQ extreme');
//$pruebaUpdate->setEstado('Inactivo');

// Prueba imagen registrada
//$pruebImagenRegis = Imagenes::imagenRegistrada(3,'c:proyecto\imagenes\imagen3.png');
//var_dump($pruebImagenRegis);

//Prueba delete
//$pruebaDelete = Imagenes::searchForId(3);
//$pruebaDelete->deleted();
//print_r($pruebaDelete->jsonSerialize());

// Prueba search
//$pruebaSearch = Imagenes::search("SELECT id,Nombre,Ruta FROM imagen WHERE Ruta = 'c:proyecto\imagenes\imagen1.png'");
///* @var $pruebaSearch App\Models\Imagenes[] */
//foreach ($pruebaSearch as $Imagen)
//{
//    print_r($Imagen->jsonSerialize());
//}

// Prueba getAll
//$pruebGetAll = Imagenes::getAll();
///* @var $pruebGetAll App\Models\Imagenes[] */
//foreach ($pruebGetAll as $Imagen)
//{
//    print_r($Imagen->jsonSerialize());
//}
