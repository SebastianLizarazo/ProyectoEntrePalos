<?php

require("..\app\Models\SubCategorias.php");

use App\Models\SubCategorias;

$arrSubCategoria = [

    'Nombre' => 'Hamburguesa',
    'CategoriaProducto' => 'Comida',
    'Estado' => 'Inactivo',
];

$arrSubCategoria2 = [
    'Nombre' => 'Pepsi',
    'CategoriaProducto' => 'Bebida',
    'Estado' => 'Activo',
];

$objSubcategoria = new SubCategorias($arrSubCategoria); // Creamos un usuario... Pero no echo nada con el.
$objSubcategoria->insert(); //Registramos el objeto en la base de datos

$objSubcategoria->setNombre("Cerveza"); //Cambio Valores
$objSubcategoria->setCategoriaProducto("Bebida"); //Cambio Valores
$objSubcategoria->update();

$objSubcategoria->deleted();

$arrSubCategoria2 = new SubCategorias($arrSubCategoria2);
$arrSubCategoria2->insert();

$arrResult = SubCategorias::search("SELECT * FROM subcategoria WHERE CategoriaProducto = 'Bebida'");
if (!empty($arrResult)) {
    /* @var $arrResult SubCategorias[] */
    foreach ($arrResult as $subCategorias) {
        echo "Nombre: " . $subCategorias->getId() . " - " . $subCategorias->getNombre() . "\n";
    }
}
$arrSubCategoria2 = SubCategorias::searchForId(3);
if (!empty($arrSubCategoria2)) {
    $arrSubCategoria2->setEstado('Inactivo');
    $arrSubCategoria2->update();
}

$arrSubc = SubCategorias::getAll();
$arrSubc = SubCategorias::getAll();
if (!empty($arrSubc)) {
    /* @var $arrSubc SubCategorias[] */
    foreach ($arrSubc as $subCategorias) {
        echo "id: " . $subCategorias->getId() . ", Nombre: " . $subCategorias->getNombre() . ", Categoria del producto: " . $subCategorias->getCategoriaProducto() . ", Estado: " . $subCategorias->getEstado() . "\n";
    }
}

$arrSubCategoria2 = SubCategorias::searchForId(5);
echo json_encode($arrSubCategoria2);