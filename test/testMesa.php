<?php

require ("..\app\Models\Mesas.php");
use App\Models\Mesas;

$arrMesa=[//creamos un array ficticio
    'Numero'=> '1',
    'Ubicacion'=> 'Ventana 1',
    'Capacidad'=> '5',
    'Ocupacion'=> 'disponible'
];

$objectMesa = new Mesas($arrMesa);//Creamos un usuario.. pero no e echo nada con el
$objectMesa->insert();//Aca registramos el objeto en la bd
