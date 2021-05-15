<?php

require ("..\app\Models\Usuarios.php");
use App\Models\Usuarios;

$arrUsuario1=[
    'Cedula' => '1193088983',
    'Nombres' => 'David Felipe',
    'Apellidos' => 'Diaz Vargas',
    'Telefono' => 3132307498,
    'Direccion' => 'Av coyote 12-56',
    'Email' => 'entrepalospoderoso@gmail.com',
    'Contrasena' => 'jehova12',
    'Rol' => 'Mesero',
    'Estado' => 'Activo',
    'Empresa_id' => 1
];

$arrUsuario2=[
    'Cedula' => '1198648983',
    'Nombres' => 'Sebastian Eduardo',
    'Apellidos' => 'Molano Diaz',
    'Telefono' => 3136307498,
    'Direccion' => 'Av currucui 12-56',
    'Email' => 'entrepalosproso@gmail.com',
    'Contrasena' => 'jehov232',
    'Rol' => 'Proveedor',
    'Estado' => 'Activo',
    'Empresa_id' => 1
];

$arrUsuario3=[
    'Cedula' => '1193094783',
    'Nombres' => 'Bladimir Alejandro',
    'Apellidos' => 'Rojas Pinilla',
    'Telefono' => 3197807498,
    'Direccion' => 'calle 72-56',
    'Email' => 'listopalospoderoso@gmail.com',
    'Contrasena' => 'jehoo373',
    'Rol' => 'Mesero',
    'Estado' => 'Activo',
    'Empresa_id' => 1
];

$objectUsuario1= new Usuarios($arrUsuario1);
//var_dump($objectUsuario1);
//$objectUsuario1->insert();

//$objectUsuario1->setCedula(1193099653);
//$objectUsuario1->setApellidos('Sandoval Pirri');
//var_dump($objectUsuario1);
//$objectUsuario1->update();

$objectUsuario2= new Usuarios($arrUsuario2);
//var_dump($objectUsuario2);
//$objectUsuario2->insert();
$objectUsuario2->setEstado('Inactivo');
$objectUsuario2->update();

//$objectUsuario3= new Usuarios($arrUsuario3);
//var_dump($objectUsuario3);
//$objectUsuario3->insert();
