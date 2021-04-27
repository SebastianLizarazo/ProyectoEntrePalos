<?php


namespace App\Models;

require ("AbstractDBConnection.php");
require (__DIR__."\..\Interfaces\Model.php");
require(__DIR__ .'/../../vendor/autoload.php');

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;


/**
 *La clase mesa es hija de AbstractDBConnection e implementa la
 * interfaz Model
 */
class Mesas extends AbstractDBConnection implements Model
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private int $Numero;
    private string $Ubicacion;
    private int $Capacidad;
    private string $Ocupacion;

    /**
     * Mesas constructor.
     * @param array $mesa
     * El constructor recibe como parametro un array cuando se estan solicitando parametros de una tabla grande
     * y ese array va a guardar todos los parametros
     */
    public function __construct(array $mesa=[])
    {
        parent::__construct();//llamamos al constructor de la clase AbstractDBConnection
        $this->setId($mesa['id']?? null);
        $this->setNumero($mesa['Numero']?? 0);//Si en el array mesa hay un contenido en el indice Numero asignelo de lo contrario ponga
        //un cero
        $this->setUbicacion($mesa['Ubicacion']??'');
        $this->setCapacidad($mesa['Capacidad']??0) ;
        $this->setOcupacion($mesa['Ocupacion']??'disponible' );
    }

    public function __destruct()
    {
        //isConnected y Disconnect son metodos de la clase AbstractDBConnection
        if ($this->isConnected()){//pregunta si la base de datos esta conectada
            $this->Disconnect();//destruye la coneccion
        }
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->Numero;
    }

    /**
     * @param int $Numero
     */
    public function setNumero(int $Numero): void
    {
        $this->Numero = $Numero;
    }

    /**
     * @return string
     */
    public function getUbicacion(): string
    {
        return $this->Ubicacion;
    }

    /**
     * @param string $Ubicacion
     */
    public function setUbicacion(string $Ubicacion): void
    {
        $this->Ubicacion = $Ubicacion;
    }

    /**
     * @return int
     */
    public function getCapacidad(): int
    {
        return $this->Capacidad;
    }

    /**
     * @param int $Capacidad
     */
    public function setCapacidad(int $Capacidad): void
    {
        $this->Capacidad = $Capacidad;
    }

    /**
     * @return string
     */
    public function getOcupacion(): string
    {
        return $this->Ocupacion;
    }

    /**
     * @param string $Ocupacion
     */
    public function setOcupacion(string $Ocupacion): void
    {
        $this->Ocupacion = $Ocupacion;
    }

    /**
     * @param string $query
     * @return bool|null
     * Este metodo es heredado obligatoriamente de la clase AbstractDBConnection
     * con la unica especificacion de que como parametro debe recibir un query,
     * Este metodo nos protege de inyecciones de datos maliciosos.
     * El query que recibe puede ser el query del insert o update o delete y los organiza
     * para prepararlos para enviarlos al insertRow.
     */
    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' =>    $this->getId(),
            ':Numero' =>   $this->getNumero(),
            ':Ubicacion' =>   $this->getUbicacion(),
            ':Capacidad' =>   $this->getCapacidad(),
            ':Ocupacion' =>   $this->getOcupacion(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);//insertRow es el que inserta los datos que organiza el save
        $this->Disconnect();
        return $result;
    }
    /**
     * @return bool|null
     */
    public function insert(): ?bool
    {
        $query = "INSERT INTO Mesas VALUES (
            :id,:Numero,:Ubicacion,:Capacidad,:Ocupacion)";
        return $this->save($query);
    }

    /**
     * @return bool|null
     * El update actualiza todos los datos del registro
     * no solo un dato(tener cuiado con ese detalle)
     */
    public function update(): ?bool
    {
        $query = "UPDATE Mesas SET 
            Numero = :Numero, Ubicacion = :Ubicacion, Capacidad = :Capacidad
            Ocupacion = :Ocupacion WHERE id = :id";
        return $this->save($query);
    }


    /**
     * Los metodos deleted, search, searchForId, getAll, jsonSerialize
     * son metodos de la interfaz Model que es obligatorio incluirlos
     */
    function deleted()
    {

    }

    static function search($query): ?array
    {
        // TODO: Implement search() method.
    }

    static function searchForId(int $id): ?object
    {
        // TODO: Implement searchForId() method.
    }

    static function getAll(): ?array
    {
        // TODO: Implement getAll() method.
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}