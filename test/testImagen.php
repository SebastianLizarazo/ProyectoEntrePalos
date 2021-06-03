<?php

require ('../app/Models/Imagenes.php');
use App\Models\Imagenes;
use App\Models\Ofertas;

$arrImage1 = [

    'Nombre' => 'Imagen Hamburguesa 1',
    'Descripcion' => 'Foto simple del producto hamburguesa doble',
    'Ruta' => 'c:proyecto/imagenes/imagen1.png',
    'Estado' => 'Activo',
    'Producto_id' => 1,
    'Oferta_id' => 2,

];$arrImage2 = [

    'Nombre' => 'Imagen Hamburguesa 2',
    'Descripcion' => 'Foto simple del producto hamburguesa triple',
    'Ruta' => 'c:proyecto/imagenes/imagen2.png',
    'Estado' => 'Activo',
    'Producto_id' => 3,
    'Oferta_id' => 1,

];$arrImage3 = [

    'Nombre' => 'Imagen Alitas BBQ 1',
    'Descripcion' => 'Foto simple del producto alitas BBQ medianas',
    'Ruta' => 'c:proyecto/imagenes/imagen3.png',
    'Estado' => 'Activo',
    'Producto_id' => 2,
    'Oferta_id' => 1,

];$arrImage4 = [

    'Nombre' => 'Imagen Gaseosa Coca Cola',
    'Descripcion' => 'Foto de la gaseosa Coca Cola en baso de vidrio',
    'Ruta' => 'c:proyecto/imagenes/imagen4.png',
    'Estado' => 'Inactivo',
    'Producto_id' => 2,
    'Oferta_id' => 2,

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
//$pruebaUpdate->setNombre('BBQ');
//$pruebaUpdate->setEstado('Inactivo');
//$pruebaUpdate->update();

// Prueba imagen registrada
//$pruebImagenRegis = Imagenes::imagenRegistrada(4,'c:proyecto/imagenes/imagen4.png');
//var_dump($pruebImagenRegis);

//Prueba delete
//$pruebaDelete = Imagenes::searchForId(3);
//$pruebaDelete->deleted();
//print_r($pruebaDelete->jsonSerialize());

// Prueba search
//$pruebaSearch = Imagenes::search("SELECT * FROM imagen WHERE id = 1");
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

//Prueba relaciones imagen
//Prueba oferta imagen
//$pruebOfer = Ofertas::searchForId(2);
//print_r($pruebOfer->getImagenOferta());

//$pruebImgOfer =Imagenes::searchForId(3);
//print_r($pruebImgOfer->getOferta());