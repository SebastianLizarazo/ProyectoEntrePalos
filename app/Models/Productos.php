<?php


namespace App\Models;

require ("AbstractDBConnection.php");
require (__DIR__."\..\Interfaces\Model.php");
require(__DIR__ .'/../../vendor/autoload.php');

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;

class Productos extends AbstractDBConnection implements Model
{
    private ?int  $id;
    private  string $Nombre;
    private  int $Tamaño;
    private  string $ReferenciaTamaño;
    private  string $Referencia;
    private  int $PrecioBase;
    private  int $PrecioUnidadTrabajador;
    private  int $PrecioUnidadVenta;
    private  string $PresentacionProducto;
    private  int $Marca_id;
    private  int $CantidadProducto;
    private  int $SubCategoria_id;
    private  string $Estado;

    /**
     * Productos constructor.
     * @param int|null $id
     * @param string $Nombre
     * @param int $Tamaño
     * @param string $ReferenciaTamaño
     * @param string $Referencia
     * @param int $PrecioBase
     * @param int $PrecioUnidadTrabajador
     * @param int $PrecioUnidadVenta
     * @param string $PresentacionProducto
     * @param int $Marca_id
     * @param int $CantidadProducto
     * @param int $SubCategoria_id
     * @param string $Estado
     */
    public function __construct(array $producto=[])
    {
        $this->setid( $producto['id']?? null);
        $this->setNombre( $producto['Nombre']?? '');
        $this->setTamaño( $producto['Tamaño']?? 0);
        $this->setReferenciaTamaño( $producto['ReferenciaTamaño']?? '');
        $this->setReferencia( $producto['Referencia']?? '');
        $this->setPrecioBase( $producto['PrecioBase']?? 0);
        $this->setPrecioUnidadTrabajador( $producto['PrecioUnidadTrabajador']?? 0);
        $this->setPrecioUnidadVenta( $producto['PrecioUnidadVenta']?? 0);
        $this->setPresentacionProducto( $producto['PresentacionProducto']?? '');
        $this->setMarcaid( $producto['Marca_id']?? null);
        $this->setCantidadProducto( $producto['CantidadProducto']?? 0);
        $this->setSubCategoriaid( $producto['']?? null);
        $this->setEstado($producto['Estado']?? '');
    }

    public function __destruct()
    {
        if ($this->isConnected()){
            $this->Disconnect();
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
     * @return int
     */
    public function getTamaño(): int
    {
        return $this->Tamaño;
    }

    /**
     * @param int $Tamaño
     */
    public function setTamaño(int $Tamaño): void
    {
        $this->Tamaño = $Tamaño;
    }

    /**
     * @return string
     */
    public function getReferenciaTamaño(): string
    {
        return $this->ReferenciaTamaño;
    }

    /**
     * @param string $ReferenciaTamaño
     */
    public function setReferenciaTamaño(string $ReferenciaTamaño): void
    {
        $this->ReferenciaTamaño = $ReferenciaTamaño;
    }

    /**
     * @return string
     */
    public function getReferencia(): string
    {
        return $this->Referencia;
    }

    /**
     * @param string $Referencia
     */
    public function setReferencia(string $Referencia): void
    {
        $this->Referencia = $Referencia;
    }

    /**
     * @return int
     */
    public function getPrecioBase(): int
    {
        return $this->PrecioBase;
    }

    /**
     * @param int $PrecioBase
     */
    public function setPrecioBase(int $PrecioBase): void
    {
        $this->PrecioBase = $PrecioBase;
    }

    /**
     * @return int
     */
    public function getPrecioUnidadTrabajador(): int
    {
        return $this->PrecioUnidadTrabajador;
    }

    /**
     * @param int $PrecioUnidadTrabajador
     */
    public function setPrecioUnidadTrabajador(int $PrecioUnidadTrabajador): void
    {
        $this->PrecioUnidadTrabajador = $PrecioUnidadTrabajador;
    }

    /**
     * @return int
     */
    public function getPrecioUnidadVenta(): int
    {
        return $this->PrecioUnidadVenta;
    }

    /**
     * @param int $PrecioUnidadVenta
     */
    public function setPrecioUnidadVenta(int $PrecioUnidadVenta): void
    {
        $this->PrecioUnidadVenta = $PrecioUnidadVenta;
    }

    /**
     * @return string
     */
    public function getPresentacionProducto(): string
    {
        return $this->PresentacionProducto;
    }

    /**
     * @param string $PresentacionProducto
     */
    public function setPresentacionProducto(string $PresentacionProducto): void
    {
        $this->PresentacionProducto = $PresentacionProducto;
    }

    /**
     * @return int
     */
    public function getMarcaId(): int
    {
        return $this->Marca_id;
    }

    /**
     * @param int $Marca_id
     */
    public function setMarcaId(int $Marca_id): void
    {
        $this->Marca_id = $Marca_id;
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
     * @return int
     */
    public function getSubCategoriaId(): int
    {
        return $this->SubCategoria_id;
    }

    /**
     * @param int $SubCategoria_id
     */
    public function setSubCategoriaId(int $SubCategoria_id): void
    {
        $this->SubCategoria_id = $SubCategoria_id;
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


    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id',
            ':Nombre' => $this->getNombre(),
            ':Tamaño' => $this->getTamaño(),
            ':ReferenciaTamaño' => $this->getReferenciaTamaño(),
            ':Referencia' => $this->getReferencia(),
            ':PrecioBase' => $this->getPrecioBase(),
            ':PrecioUnidadTrabajador' => $this->getPrecioUnidadTrabajador(),
            ':PrecioUnidadVenta' => $this->getPrecioUnidadVenta(),
            ':PresentacionProducto' => $this->getPresentacionProducto(),
            ':Marca_id' => $this->getMarcaId(),
            ':CantidadProducto' => $this->getCantidadProducto(),
            ':SubCategoria_id' => $this->getSubCategoriaId(),
            ':Estado' => $this->getEstado(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }

    function insert()
    {
        $query = "INSERT INTO producto VALUES (
            :id, :Nombre, :Tamaño, :ReferenciaTamaño, :Referencia, :PrecioBase, 
            :PrecioUnidadTrabajador, :PrecioUnidadVenta, :PresentacionProducto, :Marca_id, 
            :CantidadProducto, :SubCategoria_id, :Estado )";
        //return $this->save($query);
        if ($this->save($query)) {
            $idProducto = $this->getLastId('producto');
            $this->setId($idProducto);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
            return true;
        }else{
            return false;
        }
    }

    function update()
    {
        // TODO: Implement update() method.
    }

    function deleted()
    {
        // TODO: Implement deleted() method.
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