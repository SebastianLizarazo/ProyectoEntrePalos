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

class ConsumoTrabajadores extends AbstractDBConnection implements Model
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private int $Pago_id;
    private int $Producto_id;
    private int $CantidadProducto;
    private string $Descripcion;

    /**
     * ConsumoTrabajadores constructor.
     */
    public function __construct(array $consumoTrabajador=[])
    {
        parent::__construct();//llamamos al constructor de la clase AbstractDBConnection
        $this->setId($consumoTrabajador['id']?? null);
        $this->setPagoId($consumoTrabajador['Pago_id']?? 0);
        $this->setProductoId($consumoTrabajador['Producto_id']??0);
        $this->setCantidadProducto($consumoTrabajador['CantidadProducto']??0) ;
        $this->setDescripcion($consumoTrabajador['Descripcion']??'');
    }
    public static function consumoTrabajadorRegistrada(mixed $CantidadProducto, mixed $Descripcion): bool
    {
        $consumotbjTmp = ConsumoTrabajadores::search("SELECT * FROM consumotrabajador WHERE CantidadProducto = '$CantidadProducto' and Descripcion = '$Descripcion'");
        return (!empty($consumotbjTmp)) ? true : false;
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
    public function getPagoId(): int
    {
        return $this->Pago_id;
    }

    /**
     * @param int $Pago_id
     */
    public function setPagoId(int $Pago_id): void
    {
        $this->Pago_id = $Pago_id;
    }

    /**
     * @return int
     */
    public function getProductoId(): int
    {
        return $this->Producto_id;
    }

    /**
     * @param int $Producto_id
     */
    public function setProductoId(int $Producto_id): void
    {
        $this->Producto_id = $Producto_id;
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
    public function getProducto():?Productos
    {
        if (!empty($this->Producto_id))
        {
            return Productos::searchForId($this->Producto_id)?? new Productos();
        }
        return null;
    }
    public function getProductos():?Productos
    {
        if (!empty($this->Producto_id))
        {
            return Productos::searchForId($this->Producto_id)?? new Productos();
        }
        return null;
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

    public function getPagos(): ?Pagos
    {
        if (!empty($this->Pago_id)) {
            return Pagos::searchForId($this->Pago_id) ?? new Pagos();
        }
        return null;
    }

    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' =>    $this->getId(),
            ':Pago_id' =>   $this->getPagoId(),
            ':Producto_id' =>   $this->getProductoId(),
            ':CantidadProducto' =>   $this->getCantidadProducto(),
            ':Descripcion' =>   $this->getDescripcion(),
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
        $query = "INSERT INTO consumotrabajador VALUES (
            :id,:Pago_id,:Producto_id,:CantidadProducto,:Descripcion)";
        //return $this->save($query);
        if ($this->save($query)) {
            $idConsumoTrabajador = $this->getLastId('consumotrabajador');
            $this->setId($idConsumoTrabajador);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
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
        $query = "UPDATE consumotrabajador SET 
            Pago_id = :Pago_id, Producto_id = :Producto_id, CantidadProducto = :CantidadProducto,
            Descripcion = :Descripcion WHERE id = :id";
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
            $arrConsumoTrabajadores = array();
            $tmp = new ConsumoTrabajadores();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $ConsumoTrabajador = new ConsumoTrabajadores($valor);
                    array_push($arrConsumoTrabajadores, $ConsumoTrabajador);//aca meter el contenido del segundo parametro dentro del primero
                    unset($ConsumoTrabajador); //Borrar el contenido del objeto
                }
                return $arrConsumoTrabajadores;
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
    static function searchForId(int $id): ?ConsumoTrabajadores
    {
        try {
            if ($id > 0) {
                $tmpConsumoTrabajador = new ConsumoTrabajadores();
                $tmpConsumoTrabajador->Connect();
                $getrow = $tmpConsumoTrabajador->getRow("SELECT * FROM consumotrabajador WHERE id = ?", array($id) );

                $tmpConsumoTrabajador->Disconnect();
                return ($getrow) ? new ConsumoTrabajadores($getrow) : null;
            } else {
                throw new Exception('Id de consumo trabajador Invalido');
            }
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function getAll(): ?array
    {
        return ConsumoTrabajadores::search("SELECT * FROM consumotrabajador");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Pago_id' =>$this->getPagoId(),
            'Producto_id' =>$this->getProductoId(),
            'CantidadProducto' =>$this->getCantidadProducto(),
            'Descripcion' =>$this->getDescripcion(),
        ];
    }
}