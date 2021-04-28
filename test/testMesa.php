<?php
//Este archivo es para hacer pruebas unitarias de la clase Mesa
require ("..\app\Models\Mesas.php");//Importamos la clase Mesas
use App\Models\Mesas;

$arrMesa=[//creamos un array ficticio
    'Numero'=> 1,
    'Ubicacion'=> 'Ventana 1',
    'Capacidad'=> 5,
    'Ocupacion'=> 'disponible'
];

/**
 * Primero creo el objeto y luego lo inserto en la BD
 */
$objectMesa1 = new Mesas($arrMesa);//Creamos un objeto Mesa.. pero no e echo nada con el
$objectMesa1->insert();//Aca registramos el objeto en la bd

//var_dump($objectMesa);
$objectMesa1->setId($objectMesa1->getLastId('mesa'));//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
$objectMesa1->setUbicacion('Balcon');//Cambiamos la ubicacion del objetoMesa1
$objectMesa1->setNumero(4);//Cambiamos el numero de mesa

$objectMesa1->update();//para poder actualizar un registro se debe tener claro el Id de ese registro