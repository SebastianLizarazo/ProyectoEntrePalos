<?php
require("..\app\Models\Marcas.php");

use App\Models\Marcas;
use App\Models\Productos;
$arrMarca1 = [
    'Nombre' => 'panzote',
    'Descripcion' => 'Pan',
    'Proveedor_id' => '3',
    'Estado' => 'Inactiva',
];
$arrMarca2 = [
    'Nombre' => 'Campollo',
    'Descripcion' => 'Pollo',
    'Proveedor_id' => '1',
    'Estado' => 'Inactiva',
];
$arrMarca3 = [
    'Nombre' => 'Campollo',
    'Descripcion' => 'Alitas',
    'Proveedor_id' => '1',
    'Estado' => 'Activa',
];
//$objMarca1 = new Marcas($arrMarca1);
//var_dump($objMarca1);
//$objMarca1->insert();

//$objMarca1->setNombre("Zafran"); //Cambio Valores
//$objMarca1->setDescripcion("Guacamole"); //Cambio Valores
//$objMarca1->update();

//$objMarca1->deleted();

//$objMarca2 = new Marcas($arrMarca2);
//$objMarca2->insert();

//$arrResult = Marcas::search("SELECT * FROM marca WHERE Nombre = 'Panzote'");
//if (!empty($arrResult)) {
  ///* @var $arrResult Marcas[] */
    //foreach ($arrResult as $marca) {
      //  echo "Nombre: " . $marca->getId() . " - " . $marca->getNombre() . "\n";
    //}
//}
//$arrMarca2 = Marcas::searchForId(3);
//if (!empty($arrMarca2)) {
  //$arrMarca2->setEstado('Inactiva');
  //  $arrMarca2->update();
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

//$objectMarca3= new Marcas( $arrMarca3);
//var_dump($objectMarca3);
//$objectMarca3->insert();

//$pruebaMarcaRegist= Marcas::marcaRegistrada('panzote',1);// Comprobamos que ya exista una marca con esas caracteristicas
//var_dump($pruebaMarcaRegist);
$pruebaUsua = \App\Models\Usuarios::searchForId(1);

//echo "El usuario ". $pruebaUsua->getNombres() ." Estado ". $pruebaUsua->getEstado() ." Pertenece a la marca ". $pruebaUsua->getMarcasProveedor() ."\n";
print_r($pruebaUsua->getMarcasProveedor());