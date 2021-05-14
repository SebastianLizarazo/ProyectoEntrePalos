<?php
//Este archivo es para hacer pruebas unitarias de la clase Oferta
require ("..\app\Models\Ofertas.php");//Importamos la clase Ofertas
use App\Models\Ofertas;

$arrOferta1=[   //creamos un array ficticio
'Nombre'=> 'Jo',
'Descripcion'=> 'Kjkjakajkjakjckjck',
'PrecioUnidadVentaOferta'=> 52000,
'Estado'=> 'No disponible'
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
$arrOferta1 = new Ofertas($arrOferta1);   //Creamos un objeto Oferta

//var_dump($objectOferta1);
$arrOferta1->insert();//Aca registramos el objeto en la bd

$arrOferta1->setNombre('Brr');
$arrOferta1->setDescripcion('Klk');

//var_dump($objectMesa1);
$arrOferta1->update();//para poder actualizar un registro se debe tener claro el Id de ese registro

$arrOferta2= new Ofertas($arrOferta2);//Creamos un nuevo objeto oferta
$arrOferta2->insert();


$arrResult = Ofertas::search("SELECT * FROM oferta WHERE Nombre = 'Brr' AND Descripcion = 'Klk'");
//var_dump($arrResult);

if (!empty($arrResult)) {//Este if comprueba si el search devuelve un resultado o devuelve un null
/* @var $arrResult Ofertas[] */ //Esto hace que phpStorm sepa que estamos trabajando con un array de mesas
foreach ($arrResult as $Oferta) {
echo 'Oferta: ' . $Oferta->getNombre() .' PrecioUnidadVentaOferta: '.$Oferta->getPrecioUnidadVentaOferta(). "\n";


}
}

$arrOferta2= Ofertas::searchForId(2);
if (!empty($arrOferta2)){
$arrOferta2->setDescripcion('IIIHII');
$arrOferta2->update();
}

$arrOfertas = Ofertas::getAll();
if (!empty($arrOfertas)){
/* @var $arrOfertas Ofertas[] */
foreach ($arrOfertas as $Oferta){
echo "Nombre: ".$Oferta->getNombre()." Descripcion: ".$Oferta->getDescripcion()."\n";
}

}

$JsonOferta2 = Ofertas::searchForId(2);
echo json_encode($JsonOferta2);



