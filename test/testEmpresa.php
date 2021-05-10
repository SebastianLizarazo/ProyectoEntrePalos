<?php

require ("..\app\Models\Empresas.php");
use App\Models\Empresas;

$arrEmpresa1=[
    'Nombre' => 'miscro',
    'NIT' => 'nt88983456',
    'Telefono' => 3119873128,
    'Direccion' => 'Av coyote 12-56',
    'Estado' => 'Activo',
    'Municipio_id' => 8849
];

$arrEmpresa2=[
    'Nombre' => 'lizc',
    'NIT' => 'mm8765567',
    'Telefono' => 3207651298,
    'Direccion' => 'Av el dorado 89-33',
    'Estado' => 'Activo',
    'Municipio_id' => 5770
];

/**
* Primero creo el objeto y luego lo inserto en la BD
*/

$objectEmpresa1= new Empresas($arrEmpresa1);
//var_dump($objectEmpresa1);
$objectEmpresa1->insert();

//$objectEmpresa1->setNombre('Kivens');
//$objectEmpresa1->setDireccion('Av mosca 33-88');

//$objectEmpresa1->update();
//

//$objectEmpresa2= new Empresas($arrEmpresa2);
//$objectEmpresa2->insert();
//$arrResult = Empresas::search("SELECT * FROM empresa WHERE Nombre = 'Kivens' AND Direccion 'Av mosca 33-88'");

//if (!empty($arrResult)) {
   // /* @var $arrResult Empresas[] */
   // foreach ($arrResult as $Empresa) {
   //     echo 'Empresa: ' . $Empresa->getNombre() .' Ocupacion: '.$Empresa->getDireccion(). "\n";


  //  }
//}

//$objEmpresa2= Empresa::searchForId(2);
//if (!empty($objMesa2)){
 //   $objMesa2->setUbicacion('Primer piso');
 //   $objMesa2->update();
//}


