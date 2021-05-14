<?php
require("..\app\Models\Marcas.php");

use App\Models\Marcas;

$arrMarca = [

    'Nombre' => 'panzote',
    'Descripcion' => 'Pan',
    'Proveedor id' => '3',
    'Estado' => 'Inactiva',
];
$arrMarca2 = [
    'Nombre' => 'panzote',
    'Descripcion' => 'Pan',
    'Proveedor id' => '3',
    'Estado' => 'Inactiva',
];

$objMarca = new Marcas($arrMarca);
var_dump($objMarca);
$objMarca->insert();

//$objMarca->setNombre("Zafran"); //Cambio Valores
//$objMarca->setDescripcion("Guacamole"); //Cambio Valores
//$objMarca->update();

//$objMarca->deleted();

//$objMarca2 = new Marcas($arrMarca2);
//$objMarca2->insert();

//$arrResult = Marcas::search("SELECT * FROM marca WHERE Nombre = 'Bimbo'");
//if (!empty($arrResult)) {
  // /* @var $arrResult Marcas[] */
    //foreach ($arrResult as $marca) {
      //  echo "Nombre: " . $marca->getId() . " - " . $marca->getNombre() . "\n";
    //}
//}
//$arrMarca2 = Marcas::searchForId(3);
//if (!empty($arrMarca2)) {
  //$arrMarca2->setEstado('Inactivo');
    //$arrMarca2->update();
//}
//$arrMarc = Marcas::getAll();
//$arrMarc = Marcas::getAll();
//if (!empty($arrMarc)) {
  //  /* @var $arrMarc Marcas[] */
    //foreach ($arrMarc as $Marcas) {
      //  echo "id: " . $Marcas->getId() . ", Nombre: " . $Marcas->getNombre() . ", Descripcion de la marca: " . $Marcas->getDescripcion() . ", Estado: " . $Marcas->getEstado() . "\n";
 //}
//}
//$arrMarca2 = Marcas::searchForId(5);
//echo json_encode($arrMarca2);