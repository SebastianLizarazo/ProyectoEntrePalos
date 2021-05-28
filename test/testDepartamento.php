<?php

require ("..\app\Models\Departamentos.php");
use App\Models\Departamentos;
use App\Models\Municipios;

$depBoyaca= Departamentos::searchForId(15);
//print_r($depBoyaca->jsonSerialize());

//$depSearch= Departamentos::search("SELECT * FROM departamento where estado='Activo'");
///* @var $depSearch \App\Models\Departamentos[] */
//foreach ($depSearch as $departamento){
 //   echo $departamento->getEstado()."-".$departamento->getNombre()."\n";
//}

//$pruebRel= $depBoyaca->getMunicipiosDepartamento();
///* @var $pruebRel \App\Models\Municipios[] */
//foreach ($pruebRel as $Mun){
//    echo $Mun->getNombre()."\n";
//}

$pruebaMun = Municipios::searchForId(15759);

echo "El municipio ". $pruebaMun->getNombre() ." Estado ". $pruebaMun->getEstado() ." Pertenece al departamento ". $pruebaMun->getDepartamento() ."\n";
print_r($pruebaMun->getDepartamento()->getMunicipiosDepartamento());//Los municipios hermanos de sogamoso