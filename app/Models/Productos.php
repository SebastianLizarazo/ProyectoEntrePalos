<?php


namespace App\Models;

require_once ("AbstractDBConnection.php");
require_once (__DIR__."\..\Interfaces\Model.php");
require_once (__DIR__ .'/../../vendor/autoload.php');

use App\Interfaces\Model;


class Productos extends AbstractDBConnection implements Model
{
    private ?int  $id;
    private  string $Nombre;
    private  int $Tamano;
    private  string $ReferenciaTamano;
    private  string $Referencia;
    private  int $PrecioBase;
    private  int $PrecioUnidadTrabajador;
    private  int $PrecioUnidadVenta;
    private  string $PresentacionProducto;
    private  int $Marca_id;
    private  int $CantidadProducto;
    private  int $Subcategoria_id;
    private  string $Estado;



    /**
     * Productos constructor.
     * @param int|null $id
     * @param string $Nombre
     * @param int $Tamano
     * @param string $ReferenciaTamano
     * @param string $Referencia
     * @param int $PrecioBase
     * @param int $PrecioUnidadTrabajador
     * @param int $PrecioUnidadVenta
     * @param string $PresentacionProducto
     * @param int $Marca_id
     * @param int $CantidadProducto
     * @param int $Subcategoria_id
     * @param string $Estado
     */

    private ?array $ImagenProductos;
    private ?array $DetalleOfertaProductos;
    private ?array $DetallePedidoProductos;
    private ?array $ConsumoTrabajadorProductos;

    public function __construct(array $producto=[])
    {
        parent::__construct();
        $this->setId( $producto['id']?? null);
        $this->setNombre( $producto['Nombre']?? '');
        $this->setTamano( $producto['Tamano']?? 0);
        $this->setReferenciaTamano( $producto['ReferenciaTamano']?? '');
        $this->setReferencia( $producto['Referencia']?? '');
        $this->setPrecioBase( $producto['PrecioBase']?? 0);
        $this->setPrecioUnidadTrabajador( $producto['PrecioUnidadTrabajador']?? 0);
        $this->setPrecioUnidadVenta( $producto['PrecioUnidadVenta']?? 0);
        $this->setPresentacionProducto( $producto['PresentacionProducto']?? '');
        $this->setMarcaId( $producto['Marca_id']?? 0);
        $this->setCantidadProducto( $producto['CantidadProducto']?? 0);
        $this->setSubcategoriaId( $producto['Subcategoria_id']?? 0);
        $this->setEstado($producto['Estado']?? '');
    }

    public static function productoRegistrado(int $id, mixed $Referencia): bool
    {
        $prdTmp= Productos::search("SELECT * FROM producto WHERE id = '$id' and Referencia = '$Referencia'");
        return (!empty($prdTmp)? true : false);
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
    public function getTamano(): int
    {
        return $this->Tamano;
    }

    /**
     * @param int $Tamano
     */
    public function setTamano(int $Tamano): void
    {
        $this->Tamano = $Tamano;
    }

    /**
     * @return string
     */
    public function getReferenciaTamano(): string
    {
        return $this->ReferenciaTamano;
    }

    /**
     * @param string $ReferenciaTamano
     */
    public function setReferenciaTamano(string $ReferenciaTamano): void
    {
        $this->ReferenciaTamano = $ReferenciaTamano;
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
    public function getSubcategoriaId(): int
    {
        return $this->Subcategoria_id;
    }

    /**
     * @param int $Subcategoria_id
     */
    public function setSubcategoriaId(int $Subcategoria_id): void
    {
        $this->Subcategoria_id = $Subcategoria_id;
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
    public function getSubcategoria():?SubCategorias
    {
        if (!empty($this->Subcategoria_id))
        {
            return SubCategorias::searchForId($this->Subcategoria_id)?? new SubCategorias();
        }
        return null;
    }
    public function getMarca():?Marcas
    {
        if (!empty($this->Marca_id))
        {
            return Marcas::searchForId($this->Marca_id)?? new Marcas();
        }
        return null;
    }
    public function getImagenProductos(): ?array
    {
        //if (!empty($this->ImagenProductos)) {
        $this->ImagenProductos = Imagenes::search(
            "SELECT * FROM imagen WHERE Producto_id = ".$this->getId()
        );
        return ($this->ImagenProductos)?? null;
        //}
        //return null;
    }
    public function getDetalleOfertaProductos(): ?array
    {
        //if (!empty($this->DetalleOfertaProductos)) {
        $this->DetalleOfertaProductos = DetalleOfertas::search(
            "SELECT * FROM detalleoferta WHERE Producto_id = ".$this->getId()
        );
        return ($this->DetalleOfertaProductos)?? null;
        //}
        //return null;
    }
    public function getDetallePedidoProductos(): ?array
    {
        //if (!empty($this->DetallePedidoProductos)) {
        $this->DetallePedidoProductos = DetallePedidos::search(
            "SELECT * FROM detallepedido WHERE Producto_id = ".$this->getId()
        );
        return ($this->DetallePedidoProductos)?? null;
        //}
        //return null;
    }
    public function getConsumoTrabajadorProductos(): ?array
    {
        //if (!empty($this->ConsumoTrabajadorProductos)) {
        $this->ConsumoTrabajadorProductos = ConsumoTrabajadores::search(
            "SELECT * FROM consumotrabajador WHERE Producto_id = ".$this->getId()
        );
        return ($this->ConsumoTrabajadorProductos)?? null;
        //}
        //return null;
    }
    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' => $this->getId(),
            ':Nombre' => $this->getNombre(),
            ':Tamano' => $this->getTamano(),
            ':ReferenciaTamano' => $this->getReferenciaTamano(),
            ':Referencia' => $this->getReferencia(),
            ':PrecioBase' => $this->getPrecioBase(),
            ':PrecioUnidadTrabajador' => $this->getPrecioUnidadTrabajador(),
            ':PrecioUnidadVenta' => $this->getPrecioUnidadVenta(),
            ':PresentacionProducto' => $this->getPresentacionProducto(),
            ':Marca_id' => $this->getMarcaId(),
            ':CantidadProducto' => $this->getCantidadProducto(),
            ':Subcategoria_id' => $this->getSubcategoriaId(),
            ':Estado' => $this->getEstado(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }

    public function insert()
    {
        $query = "INSERT INTO producto VALUES (
            :id, :Nombre, :Tamano, :ReferenciaTamano, :Referencia, :PrecioBase, 
            :PrecioUnidadTrabajador, :PrecioUnidadVenta, :PresentacionProducto, :Marca_id, 
            :CantidadProducto, :Subcategoria_id, :Estado )";
        //return $this->save($query);
        if ($this->save($query)) {
            $idProducto = $this->getLastId('producto');
            $this->setId($idProducto);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
            return true;
        }else{
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE producto SET
            Nombre = :Nombre, Tamano = :Tamano, ReferenciaTamano = :ReferenciaTamano, Referencia = :Referencia, PrecioBase = :PrecioBase, 
            PrecioUnidadTrabajador = :PrecioUnidadTrabajador, PrecioUnidadVenta = :PrecioUnidadVenta, PresentacionProducto = :PresentacionProducto,
            Marca_id = :Marca_id, CantidadProducto = :CantidadProducto, Subcategoria_id = :Subcategoria_id,
            Estado = :Estado WHERE id = :id";
        return $this->save($query);
    }

    public function deleted()
    {
        $this->setEstado("Inactivo");
        return $this->update();
    }

    public static function search($query): ?array
    {
        try {
            $arrProductos = array();
            $tmp = new Productos();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $Producto = new Productos($valor);
                    array_push($arrProductos, $Producto);//ingresa el contenido del segundo parametro en el primero
                    unset($Producto); //Borrar el contenido del objeto
                }
                return $arrProductos;
            }
            return null;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function searchForId(int $id): ?Productos
    {
        try {
            if ($id > 0) {
                $tmpProducto = new Productos();
                $tmpProducto->Connect();
                $getrow = $tmpProducto->getRow("SELECT * FROM producto WHERE id = ?", array($id) );

                $tmpProducto->Disconnect();
                return ($getrow) ? new Productos($getrow) : null;
            } else {
                throw new \Exception('Id de producto Invalido');
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function getAll(): ?array
    {
        return Productos::search("SELECT * FROM producto");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Nombre' => $this->getNombre(),
            'Tamano' => $this->getTamano(),
            'ReferenciaTamano' => $this->getReferenciaTamano(),
            'Referencia' => $this->getReferencia(),
            'PrecioBase' => $this->getPrecioBase(),
            'PrecioUnidadTrabajador' => $this->getPrecioUnidadTrabajador(),
            'PrecioUnidadVenta' => $this->getPrecioUnidadVenta(),
            'PresentacionProducto' => $this->getPresentacionProducto(),
            'Marca_id' => $this->getMarcaId(),
            'CantidadProducto' => $this->getCantidadProducto(),
            'Subcategoria_id' => $this->getSubcategoriaId(),
            'Estado' => $this->getEstado(),
        ];
    }
}