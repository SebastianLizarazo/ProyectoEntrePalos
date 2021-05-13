<?php

require ("..\app\Models\Empresas.php");
use App\Models\Empresas;

$arrEmpresa1=[
    'Nombre' => 'Bladi',
    'NIT' => 'nt887639876',
    'Telefono' => 3119856728,
    'Direccion' => 'Av coyote 12-56',
    'Estado' => 'Activo',
    'Municipio_id' => 5031
];

$arrEmpresa2=[
    'Nombre' => 'pool',
    'NIT' => 'mm8765567',
    'Telefono' => 3207651298,
    'Direccion' => 'Av el dorado 89-33',
    'Estado' => 'Activo',
    'Municipio_id' => 5031
];

/**
* Primero creo el objeto y luego lo inserto en la BD
*/

$objectEmpresa1= new Empresas($arrEmpresa1);
//var_dump($objectEmpresa1);
$objectEmpresa1->insert();

//$objectEmpresa1->setNombre('Kivens');
//$objectEmpresa1->setDireccion('Av mosca 33-88');
//var_dump($objectEmpresa1);
//$objectEmpresa1->update();

$objectEmpresa2= new Empresas($arrEmpresa2);//Creamos un nuevo objeto mesa
$objectEmpresa2->insert();


//$arrResult = Empresas::search("SELECT * FROM empresa WHERE Nombre = 'pool' AND Telefono = 3207651298");
//var_dump($arrResult);

//if (!empty($arrResult)) {//Este if comprueba si el search devuelve un resultado o devuelve un null
 //   /* @var $arrResult Empresas[] */ //Esto hace que phpStorm sepa que estamos trabajando con un array de mesas
 //   foreach ($arrResult as $Empresa) {
 //       echo 'Empresa: ' . $Empresa->getNombre() .' Telefono: '.$Empresa->getTelefono(). "\n";


//   }
//}

//$objEmpresa2= Empresas::searchForId(1);
//if (!empty($objEmpresa2)){
//    $objEmpresa2->setTelefono(3446267676);
//    $objEmpresa2->update();
//}

//$arrEmpresas = Empresas::getAll();
//if (!empty($arrEmpresas)){
//    /* @var $arrEmpresas Empresas[] */
//    foreach ($arrEmpresas as $Empresa){
//        echo "Nombre: ".$Empresa->getNombre()." Telefono: ".$Empresa->getTelefono()."\n";
//    }

//}

//$JsonEmpresa2 = Empresas::searchForId(1);
//echo json_encode($JsonEmpresa2);


