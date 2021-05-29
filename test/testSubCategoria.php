<?php

require("..\app\Models\SubCategorias.php");

use App\Models\SubCategorias;
use App\Models\Productos;
$arrSubCategoria1 = [

    'Nombre' => 'Hamburguesa',
    'CategoriaProducto' => 'Comida',
    'Estado' => 'Inactivo',
];

$arrSubCategoria2 = [
    'Nombre' => 'Pepsi',
    'CategoriaProducto' => 'Bebida',
    'Estado' => 'Activo',
];
$arrSubCategoria3 = [
    'Nombre' => 'Helado',
    'CategoriaProducto' => 'Postre',
    'Estado' => 'Activo',
];

//$objSubcategoria1 = new SubCategorias($arrSubCategoria1); // Creamos un usuario... Pero no echo nada con el.
//$objSubcategoria1->insert(); //Registramos el objeto en la base de datos

//$objSubcategoria1->setNombre("Cerveza"); //Cambio Valores
//$objSubcategoria1->setCategoriaProducto("Bebida"); //Cambio Valores
//$objSubcategoria1->update();

//$objSubcategoria1->deleted();

//$objSubcategoria2 = new SubCategorias($arrSubCategoria2);
//$objSubcategoria2->insert();

//$arrResult = SubCategorias::search("SELECT * FROM subcategoria WHERE CategoriaProducto = 'Bebida'");
//if (!empty($arrResult)) {
    ///* @var $arrResult SubCategorias[] */
    //foreach ($arrResult as $subCategorias) {
    //    echo "Nombre: " . $subCategorias->getId() . " - " . $subCategorias->getNombre() . "\n";
  //  }
//}
//$arrSubCategoria2 = SubCategorias::searchForId(3);
//if (!empty($arrSubCategoria2)) {
    //$arrSubCategoria2->setEstado('Inactivo');
  //  $arrSubCategoria2->update();
//}

//$arrSubc = SubCategorias::getAll();
//$arrSubc = SubCategorias::getAll();
//if (!empty($arrSubc)) {
    ///* @var $arrSubc SubCategorias[] */
    //foreach ($arrSubc as $subCategorias) {
    //    echo "id: " . $subCategorias->getId() . ", Nombre: " . $subCategorias->getNombre() . ", Categoria del producto: " . $subCategorias->getCategoriaProducto() . ", Estado: " . $subCategorias->getEstado() . "\n";
  //  }
//}

//$arrSubCategoria2 = SubCategorias::searchForId(5);
//echo json_encode($arrSubCategoria2);

//$objSubcategoria3= new SubCategorias( $arrSubCategoria3);
//var_dump($objSubcategoria3);
//$objSubcategoria3->insert();


//$pruebaSubCRegis= SubCategorias::subCategoriaRegistrada('pepsi',1);
//var_dump($pruebaSubCRegis);
$pruebaProd = Productos::searchForId(1);

//echo "El producto: ". $pruebaProd->getNombre() ." Estado ". $pruebaProd->getEstado() ." Pertenece a la subcategoria". $pruebaProd->getSubcategoria() ."\n";
print_r($pruebaProd->getSubcategoria()->getProductoSubCategoria());