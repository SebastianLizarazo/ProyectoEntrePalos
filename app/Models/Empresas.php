<?php


namespace App\Models;

require ("AbstractDBConnection.php");//Importamos la clase padre
require (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require(__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;
use PhpParser\Node\Expr\Cast\Int_;

class Empresa
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private string $Nombre;
    private string $NIT;
    private int $Telefono;
    private string $Direccion;
    private string $Estado;
    private int $Municipio_id;

}