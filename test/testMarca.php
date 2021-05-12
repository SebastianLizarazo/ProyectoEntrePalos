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

$objMarca = new Marcas($arrMarca); // Creamos un usuario... Pero no echo nada con el.
$objMarca->insert(); //Registramos el objeto en la base de datos

$objMarca->setNombre("Zafran"); //Cambio Valores
$objMarca->setDescripcion("Guacamole"); //Cambio Valores
$objMarca->update();

$objMarca->deleted();

$arrMarca2 = new Marcas($arrMarca2);
$arrMarca2->insert();

$arrResult = Marcas::search("SELECT * FROM marca WHERE Nombre = 'Bimbo'");
if (!empty($arrResult)) {
    /* @var $arrResult Marcas[] */
    foreach ($arrResult as $marca) {
        echo "Nombre: " . $marca->getId() . " - " . $marca->getNombre() . "\n";
    }
}
$arrMarca2 = Marcas::searchForId(3);
if (!empty($arrMarca2)) {
    $arrMarca2->setEstado('Inactivo');
    $arrMarca2->update();
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