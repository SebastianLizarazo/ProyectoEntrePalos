<?php
//Este archivo es para hacer pruebas unitarias de la clase Oferta
require ("..\app\Models\Ofertas.php");//Importamos la clase Ofertas
use App\Models\Ofertas;

$arrOferta1=[   //creamos un array ficticio
    'Nombre'=> 'Jo',
    'Descripcion'=> 'Kjkjakajkjakjckjck',
    'PrecioUnidadVentaOferta'=> 52000,
    'Estado'=> 'disponible'
];

$arrOferta2=[   //creamos un array ficticio
    'Nombre'=> 'Yu',
    'Descripcion'=> 'Asfgajhkhsjs',
    'PrecioUnidadVentaOferta'=> 20000,
    'Estado'=> 'disponible'
];

/**
 * Primero creo el objeto y luego lo inserto en la BD
 */
$arrOferta1 = new Mesas($arrOferta1);   //Creamos un objeto Oferta.. pero no e echo nada con el

//var_dump($objectMesa1);
$arrOferta1->insert();//Aca registramos el objeto en la bd

$arrOferta1->setDescripcion('Balcon');//Cambiamos la ubicacion del objetoOferta1
$arrOferta1->setPrecioUnidadVentaOferta(4);//Cambiamos el numero de mesa

//var_dump($objectMesa1);
$arrOferta1->update();//para poder actualizar un registro se debe tener claro el Id de ese registro

$objectMesa2= new Mesas($arrMesa2);//Creamos un nuevo objeto mesa
$objectMesa2->insert();


$arrResult = Mesas::search("SELECT * FROM mesa WHERE Ubicacion = 'Balcon' AND Capacidad = 5");
//var_dump($arrResult);

if (!empty($arrResult)) {//Este if comprueba si el search devuelve un resultado o devuelve un null
    /* @var $arrResult Mesas[] */ //Esto hace que phpStorm sepa que estamos trabajando con un array de mesas
    foreach ($arrResult as $Mesa) {
        echo 'Mesa: ' . $Mesa->getNumero() .' Ocupacion: '.$Mesa->getOcupacion(). "\n";


    }
}


$objMesa2= Mesas::searchForId(2);
if (!empty($objMesa2)){
    $objMesa2->setUbicacion('Primer piso');
    $objMesa2->update();
}

$arrMesas = Mesas::getAll();
if (!empty($arrMesas)){
    /* @var $arrMesas Mesas[] */
    foreach ($arrMesas as $Mesa){
        echo "Ubicacion: ".$Mesa->getUbicacion()." Ocupacion: ".$Mesa->getOcupacion()."\n";
    }

}

$JsonMesa2 = Mesas::searchForId(2);
echo json_encode($JsonMesa2);

