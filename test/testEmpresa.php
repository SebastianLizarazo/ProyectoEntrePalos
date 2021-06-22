<?php

require ("..\app\Models\Empresas.php");
use App\Models\Empresas;
use App\Models\Municipios;
use App\Models\Usuarios;

$arrEmpresa1=[
    'Nombre' => 'Entre Palos',
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

$arrEmpresa3=[
    'Nombre' => 'HepicGeims',
    'NIT' => 'mm8765957',
    'Telefono' => 3207654898,
    'Direccion' => 'Av el Jhony 89-33',
    'Estado' => 'Activo',
    'Municipio_id' => 15759
];


/**
* Primero creo el objeto y luego lo inserto en la BD
*/

//$objectEmpresa1= new Empresas($arrEmpresa1);
//var_dump($objectEmpresa1);
//$objectEmpresa1->insert();

//$arrEmpresa1 = Empresas::searchForId(3);
//var_dump($arrEmpresa1);
//if (!empty($arrEmpresa1)) {
//    $arrEmpresa1->setMunicipioid(5837);
//    $arrEmpresa1->update();
//}

//$arrEmpresa1 = Empresas::searchForId(1);//Llamamos al usuario que queremos modificar
//var_dump($arrEmpresa1);
//$arrEmpresa1->setEstado('Inactivo');
//$arrEmpresa1->update();
//var_dump($objectEmpresa1);

//$objectEmpresa2= new Empresas($arrEmpresa2);//Creamos un nuevo objeto mesa
//$objectEmpresa2->insert();

//$objectEmpresa3= new Empresas($arrEmpresa3);
//$objectEmpresa3->insert();

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

//$empresaGetALL = Empresas::getAll();
//var_dump($empresaGetALL);
//* @var $empresaGetALL app\Models\Empresas[] */
//foreach ($empresaGetALL as $empresa)
//{
//    print_r($empresa->jsonSerialize());
//}


//$pruebaEm = Municipios::searchForId(15759);

//echo "En el municipio ". $pruebaEm->getNombre() ." Estado ". $pruebaEm->getEstado() ." esta la empresa ". $pruebaEm->getNombre() ."\n";
//print_r($pruebaEm->getEmpresasMunicipio());//Los municipios hermanos de sogamoso


//$pruebaEm = Empresas::searchForId(1);
//print_r($pruebaEm->getMunicipio());

//$pruebaUsu = Empresas::searchForId(1);
//print_r($pruebaUsu->getUsuariosEmpresa());

//$pruebaUsu = (Usuarios::searchForId(1));
//print_r($pruebaUsu->getEmpresas());