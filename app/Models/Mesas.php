<?php


namespace App\Models;

require ("AbstractDBConnection.php");//Importamos la clase padre
require (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require(__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

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

    public static function mesaRegistrada(mixed $Numero, mixed $Capacidad): bool
    {
        $msaTmp = Mesas::search("SELECT * FROM mesa WHERE Numero = '$Numero' and Capacidad = '$Capacidad'");
        return (!empty($msaTmp)) ? true : false;
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
     * Convierte el array del constructor en un query
     * La palabra Mesa del query debe estar escrita igual que el nombre de la TABLA mesa de la DB
     * NO igual que el nombre de la clase(ojo con ese detalle).
     */
    public function insert(): ?bool
    {
        $query = "INSERT INTO Mesa VALUES (
            :id,:Numero,:Ubicacion,:Capacidad,:Ocupacion)";
        //return $this->save($query);
        if ($this->save($query)) {
            $idMesa = $this->getLastId('mesa');
            $this->setId($idMesa);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool|null
     * El update actualiza todos los datos del registro cuando el registro tenga el id especificado
     * no solo un dato(tener cuiado con ese detalle)
     */
    public function update(): ?bool
    {
        $query = "UPDATE Mesa SET 
            Numero = :Numero, Ubicacion = :Ubicacion, Capacidad = :Capacidad,
            Ocupacion = :Ocupacion WHERE id = :id";
        return $this->save($query);
    }


    /**
     * Los metodos deleted, search, searchForId, getAll, jsonSerialize
     * son metodos de la interfaz Model que es obligatorio incluirlos
     */

    /**
     * El metodo delete se implementa cuando la clase tiene como atributo un estado
     * que se puede pasar de activo a inactivo de resto no se aconseja utilizar
     * el delete o hay que pensar muy bien como utilizarlo
     */
    function deleted()
    {

    }

    static function search($query): ?array
    {
        try {
            $arrMesas = array();
            $tmp = new Mesas();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $Mesa = new Mesas($valor);
                    array_push($arrMesas, $Mesa);//aca meter el contenido del segundo parametro dentro del primero
                    unset($Mesa); //Borrar el contenido del objeto
                }
                return $arrMesas;
            }
            return null;
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    /**
     * @param int $id
     * @return Mesas|null
     * Aca tenemos que especificar que el objeto que nos va a devolver va a ser
     * en este caso un objeto Mesas porque es la clase que le corresponde a este searchForId
     */
    static function searchForId(int $id): ?Mesas
    {
        try {
            if ($id > 0) {
                $tmpMesa = new Mesas();
                $tmpMesa->Connect();
                $getrow = $tmpMesa->getRow("SELECT * FROM mesa WHERE id = ?", array($id) );

                $tmpMesa->Disconnect();
                return ($getrow) ? new Mesas($getrow) : null;
            } else {
                throw new Exception('Id de usuario Invalido');
            }
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function getAll(): ?array
    {
        return Mesas::search("SELECT * FROM mesa");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Numero' =>$this->getNumero(),
            'Ubicacion' =>$this->getUbicacion(),
            'Capacidad' =>$this->getCapacidad(),
            'Ocupacion' =>$this->getOcupacion(),
        ];
    }
}