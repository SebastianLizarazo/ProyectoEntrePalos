<?php


namespace App\Models;
require ("AbstractDBConnection.php");//Importamos la clase padre
require (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require(__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;

class Ofertas extends AbstractDBConnection implements Model
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private string $Nombre;
    private string $Descripcion;
    private int $PrecioUnidadVentaOferta;
    private string $Estado;

    /**
     * Ofertas constructor.
     */
    public function __construct(array $oferta=[])
    {
        parent::__construct();//llamamos al constructor de la clase AbstractDBConnection
        $this->setId($oferta['id']?? null);
        $this->setNombre($oferta['Nombre']??'');
        $this->setDescripcion($oferta['Descripcion']??'');
        $this->setPrecioUnidadVentaOferta($oferta['PrecioUnidadVentaOferta']??0) ;
        $this->setEstado($oferta['Estado']?? '');

    }

    public static function ofertaRegistrada(mixed $Nombre, mixed $Descripcion)
    {
            $oftTmp = Ofertas::search("SELECT * FROM oferta WHERE Nombre = '$Nombre' and Descripcion = '$Descripcion'");
            return (!empty($oftTmp)) ? true : false;
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
     * @return string
     */
    public function getNombre(): string
    {
        return $this->Nombre;
    }

    /**
     * @param string $Nombre
     */
    public function setNombre(string $Nombre): void
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->Descripcion;
    }

    /**
     * @param string $Descripcion
     */
    public function setDescripcion(string $Descripcion): void
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return int
     */
    public function getPrecioUnidadVentaOferta(): int
    {
        return $this->PrecioUnidadVentaOferta;
    }

    /**
     * @param int $PrecioUnidadVentaOferta
     */
    public function setPrecioUnidadVentaOferta(int $PrecioUnidadVentaOferta): void
    {
        $this->PrecioUnidadVentaOferta = $PrecioUnidadVentaOferta;
    }

    /**
     * @return string
     */
    public function getEstado(): string
    {
        return $this->Estado;
    }

    /**
     * @param string $Estado
     */
    public function setEstado(string $Estado): void
    {
        $this->Estado = $Estado;
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
            ':Nombre' =>   $this->getNombre(),
            ':Descripcion' =>   $this->getDescripcion(),
            ':PrecioUnidadVentaOferta' =>   $this->getPrecioUnidadVentaOferta(),
            ':Estado' =>   $this->getEstado(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }

    public function insert(): ?bool
    {
        $query = "INSERT INTO Oferta VALUES (
            :id,:Nombre,:Descripcion,:PrecioUnidadVentaOferta,:Estado)";
        //return $this->save($query);
        if ($this->save($query)) {
            $idOferta = $this->getLastId('oferta');
            $this->setId($idOferta);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla oferta
            return true;
        }else{
            return false;
        }
    }

    function update(): ?bool
    {
        $query = "UPDATE Oferta SET 
            Nombre = :Nombre, Descripcion = :Descripcion, 
            PrecioUnidadVentaOferta = :PrecioUnidadVentaOferta,
            Estado = :Estado WHERE id = :id";
        return $this->save($query);
    }

    public function deleted()
    {
        $this->setEstado("Inactivo"); //Cambia el estado del Usuario
        return $this->update();                    //Guarda los cambios..
    }

    public static function search($query): ?array
    {
        try {
            $arrOfertas = array();
            $tmp = new Ofertas();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $Oferta = new Ofertas($valor);
                    array_push($arrOfertas, $Oferta);//aca meter el contenido del segundo parametro dentro del primero
                    unset($Oferta); //Borrar el contenido del objeto
                }
                return $arrOfertas;
            }
            return null;
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function searchForId(int $id): ?Ofertas
    {
        try {
            if ($id > 0) {
                $tmpOferta = new Ofertas();
                $tmpOferta->Connect();
                $getrow = $tmpOferta->getRow("SELECT * FROM oferta WHERE id = ?", array($id) );

                $tmpOferta->Disconnect();
                return ($getrow) ? new Ofertas($getrow) : null;
            } else {
                throw new Exception('Id de oferta Invalido');
            }
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function getAll(): ?array
    {
        return Ofertas::search("SELECT * FROM oferta");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Nombre' =>$this->getNombre(),
            'Descripcion' =>$this->getDescripcion(),
            'PrecioUnidadVentaOferta' =>$this->getPrecioUnidadVentaOferta(),
            'Estado' =>$this->getEstado(),
        ];
    }
}