<?php


namespace App\Models;

require_once ("AbstractDBConnection.php");
require_once (__DIR__."\..\Interfaces\Model.php");
require_once(__DIR__ .'/../../vendor/autoload.php');


use App\Interfaces\Model;
use App\Models\AbstractDBConnection;


class Marcas extends AbstractDBConnection implements Model
{
    private ?int $id;
    private string $Nombre;
    private string $Descripcion;
    private int $Proveedor_id;
    private string $Estado;

    private ?array $ProductosMarca;

    public function __construct(array $marca=[])
    {
        parent::__construct();
        $this->setId($marca['id']?? null);
        $this->setNombre($marca['Nombre']?? '');
        $this->setDescripcion($marca['Descripcion']??'');
        $this->setProveedorid($marca['Proveedor_id']??0);
        $this->setEstado($marca['Estado']??'Activa' );
    }
    public static function marcaRegistrada (mixed $Nombre, int $idExcluir = null): bool
    {
        $query = "SELECT * FROM marca WHERE Nombre = '$Nombre' ".(empty($idExcluir) ? '' : "AND id != $idExcluir");
        $marTmp = Marcas::search($query);
        return (!empty($marTmp) ? true : false);
    }

    public function __destruct()
    {
        if ($this->isConnected()){
            $this->Disconnect();
        }
    }

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
    public function getProveedorId(): int
    {
        return $this->Proveedor_id;
    }

    /**
     * @param int $Proveedor_id
     */
    public function setProveedorId(int $Proveedor_id): void
    {
        $this->Proveedor_id = $Proveedor_id;
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

    public function getProveedor(): ?Usuarios
    {
        if (!empty($this->Proveedor_id)){
            return Usuarios::searchForId($this->Proveedor_id)?? new Usuarios();
        }
        return null;
    }
    public function getProductosMarca(): ?array
    {
        //if (!empty($this->ProductosMarca)) {
        $this->ProductosMarca = Productos::search(
            "SELECT * FROM producto WHERE Marca_id = ".$this->getId()
        );
        return ($this->ProductosMarca)?? null;
        //}
        //return null;
    }
    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' =>    $this->getId(),
            ':Nombre' =>   $this->getNombre(),
            ':Descripcion' =>   $this->getDescripcion(),
            ':Proveedor_id' =>   $this->getProveedorId(),
            ':Estado' =>   $this->getEstado(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }
    public function insert(): ?bool
    {
        $query = "INSERT INTO marca VALUES (
            :id,:Nombre,:Descripcion,:Proveedor_id,:Estado)";
        //return $this->save($query);
        if ($this->save($query)) {
            $idMarca = $this->getLastId('marca');
            $this->setId($idMarca);
            return true;
        }else{
            return false;
        }
    }
    public function update(): ?bool
    {
        $query = "UPDATE marca SET 
            Nombre = :Nombre, Descripcion = :Descripcion, Proveedor_id = :Proveedor_id,
            Estado = :Estado WHERE id = :id";
        return $this->save($query);
    }
    public function deleted(): ?bool
{
    $this->setEstado("Inactiva");
    return $this->update();
}
    public static function search($query): ?array
    {
        try {
            $arrMarcas = array();
            $tmp = new Marcas();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $Marca = new Marcas($valor);
                    array_push($arrMarcas, $Marca);
                    unset($Marca);
                }
                return $arrMarcas;
            }
            return null;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }
    public static function searchForId(int $id): ?Marcas
    {
        try {
            if ($id > 0) {
                $tmpMarca = new Marcas();
                $tmpMarca->Connect();
                $getrow = $tmpMarca->getRow("SELECT * FROM marca WHERE id = ?", array($id) );

                $tmpMarca->Disconnect();
                return ($getrow) ? new Marcas ($getrow) : null;
            } else {
                throw new \Exception('Id de marca Invalido');
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }
    public static function getAll(): ?array
    {
        return Marcas::search("SELECT * FROM marca");
    }

    public function jsonSerialize()
    {
        return [
            'id' =>    $this->getId(),
            'Nombre' =>   $this->getNombre(),
            'Descripcion' =>   $this->getDescripcion(),
            'Proveedor_id' =>   $this->getProveedorId(),
            'Estado' =>   $this->getEstado(),
        ];
    }
}