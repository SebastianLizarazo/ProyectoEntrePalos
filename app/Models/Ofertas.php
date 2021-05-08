<?php


namespace App\Models;
require ("AbstractDBConnection.php");//Importamos la clase padre
require (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require(__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;

class Oferta
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private string $Nombre;
    private string $Descripcion;
    private int $PrecioUnidadVentaOferta;
    private string $Estado;

    
}