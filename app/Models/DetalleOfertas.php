<?php


namespace App\Models;
require ("AbstractDBConnection.php");//Importamos la clase padre
require (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require(__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;

class DetalleOfertas extends AbstractDBConnection implements Model
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private int $Producto_id;
    private int $Oferta_id;
    private int $CantidadProducto;

    /**
     * DetalleOfertas constructor.
     * @param array $detalleOferta
     * El constructor recibe como parametro un array cuando se estan solicitando parametros de una tabla grande
     * y ese array va a guardar todos los parametros
     */
    public function __construct(array $detalleOferta=[])
    {
        parent::__construct();
        $this->setId($detalleOferta['id']?? null);
        $this->setProductoId($detalleOferta['Producto_id']?? 0);
        $this->setOfertaId($detalleOferta['Oferta_id']?? 0);
        $this->setCantidadProducto($detalleOferta['CantidadProducto']??0) ;
    }

    public static function detalleOfertaRegistrada(mixed $Producto_id, mixed $Oferta_id): bool
    {
        $msaTmp = DetalleOfertas::search("SELECT * FROM detalleoferta WHERE Producto id = '$Producto_id' and Oferta id = '$Oferta_id'");
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
     * @return string
     */
    public function getProductoId(): string
    {
        return $this->Producto_id;
    }

    /**
     * @param string $Producto_id
     */
    public function setProductoId(string $Producto_id): void
    {
        $this->Producto_id = $Producto_id;
    }

    /**
     * @return string
     */
    public function getOfertaId(): string
    {
        return $this->Oferta_id;
    }

    /**
     * @param string $Oferta_id
     */
    public function setOfertaId(string $Oferta_id): void
    {
        $this->Oferta_id = $Oferta_id;
    }

    /**
     * @return int
     */
    public function getCantidadProducto(): int
    {
        return $this->CantidadProducto;
    }

    /**
     * @param int $CantidadProducto
     */
    public function setCantidadProducto(int $CantidadProducto): void
    {
        $this->CantidadProducto = $CantidadProducto;
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
            ':Producto_id' =>   $this->getProductoId(),
            ':Oferta_id' =>   $this->getOfertaId(),
            ':CantidadProducto' =>   $this->getCantidadProducto(),
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
        $query = "INSERT INTO detalleoferta VALUES (
            :id,:Producto_id,:Oferta_id,:CantidadProducto)";
        //return $this->save($query);
        if ($this->save($query)) {
            $idDetalleOferta = $this->getLastId('detalleoferta');
            $this->setId($idDetalleOferta);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla detalle oferta
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
        $query = "UPDATE detalleoferta SET 
            Producto_id = :Producto_id, Oferta_id = :Oferta_id, 
            CantidadProducto = :CantidadProducto,WHERE id = :id";
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
    public function deleted()
    {

    }

    public static function search($query): ?array
    {
        try {
            $arrDetalleOferta = array();
            $tmp = new DetalleOfertas();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $DetalleOferta = new DetalleOfertas($valor);
                    array_push($arrDetalleOferta, $DetalleOferta);//aca meter el contenido del segundo parametro dentro del primero
                    unset($DetalleOferta); //Borrar el contenido del objeto
                }
                return $arrDetalleOferta;
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
    static function searchForId(int $id): ?DetalleOfertas
    {
        try {
            if ($id > 0) {
                $tmpDetalleOferta = new DetalleOfertas();
                $tmpDetalleOferta->Connect();
                $getrow = $tmpDetalleOferta->getRow("SELECT * FROM detalleoferta WHERE id = ?", array($id) );

                $tmpDetalleOferta->Disconnect();
                return ($getrow) ? new DetalleOfertas($getrow) : null;
            } else {
                throw new Exception('Id de detalle oferta Invalido');
            }
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function getAll(): ?array
    {
        return DetalleOfertas::search("SELECT * FROM detalleoferta");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Producto_id' =>$this->getProductoId(),
            'Oferta_id' =>$this->getOfertaId(),
            'CantidadProducto' =>$this->getCantidadProducto(),
        ];
    }
}


