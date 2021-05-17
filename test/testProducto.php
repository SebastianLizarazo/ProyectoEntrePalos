<?php

require ('../app/Models/Productos.php');
use App\Models\Productos;

$arrProducto1= [

    'Nombre'=> 'Coca cola cero',
    'Tamano'=> '750',
    'ReferenciaTamano'=> 'ml',
    'Referencia'=> '001-Dk',
    'PrecioBase'=> 1700,
    'PrecioUnidadTrabajador'=> 1900,
    'PrecioUnidadVenta'=> 2200,
    'PresentacionProducto'=> 'Botella vidrio',
    'Marca_id'=> 0,
    'CantidadProducto'=> 88,
    'Subcategoria_id'=> 2,
    'Estado'=> 'Activo',
];
$arrProducto2= [

    'Nombre'=> 'Hamburguesa doble',
    'Tamano'=> '400',
    'ReferenciaTamano'=> 'gr',
    'Referencia'=> '023-DN',
    'PrecioBase'=> 13000,
    'PrecioUnidadTrabajador'=> 15000,
    'PrecioUnidadVenta'=> 17000,
    'PresentacionProducto'=> 'Predeterminado',
    'Marca_id'=> 0,
    'CantidadProducto'=> 13,
    'Subcategoria_id'=> 1,
    'Estado'=> 'Activo',
]
;$arrProducto3= [

    'Nombre'=> 'Hamburguesa triple',
    'Tamano'=> '900',
    'ReferenciaTamano'=> 'gr',
    'Referencia'=> '033-DN',
    'PrecioBase'=> 19000,
    'PrecioUnidadTrabajador'=> 21000,
    'PrecioUnidadVenta'=> 23000,
    'PresentacionProducto'=> 'Predeterminado',
    'Marca_id'=> 0,
    'CantidadProducto'=> 32,
    'Subcategoria_id'=> 1,
    'Estado'=> 'Activo',
];

$producto1= new Productos($arrProducto1);
var_dump($producto1);
$producto1->insert();

$producto2= new Productos($arrProducto2);
var_dump($producto2);
$producto2->insert();

$producto3= new Productos($arrProducto3);
var_dump($producto3);
$producto3->insert();

// Prueba update
$producto2->setPrecioUnidadVenta(19000);
$producto2->setTamano(600);
$producto2->update();

// Prueba producto registrado
$pruebProdRegis=Productos::productoRegistrado('1','001-Dk');
var_dump($pruebProdRegis);

// Prueba delete
$producto3->deleted();
print_r($producto3->jsonSerialize());

// Prueba search
$pruebSearch = Productos::search("SELECT Nombre,Tamano FROM producto WHERE PrecioUnidadVenta > 20000");
/* @var $pruebSearch App\Models\Productos[] */
foreach($pruebSearch as $producto)
{
    print_r($producto->jsonSerialize());
}

// Prueba searchForId
$pruebSearchFoId = Productos::searchForId(2);
print_r($pruebSearchFoId->jsonSerialize());

// Prueba getAll
$pruebGetAll = Productos::getAll();
/* @var $pruebGetAll App\Models\Productos[] */
foreach($pruebGetAll as $producto)
{
    print_r($producto->jsonSerialize());
}
