<?php


namespace App\Models;

require ('AbstractDBConnection.php');
require (__DIR__."\..\Interfaces\Model.php");
require(__DIR__ .'/../../vendor/autoload.php');

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;

class DetallePedidos extends AbstractDBConnection implements Model
{
    private ?int $id;
    private int  $Factura_id;
    private ?int  $Producto_id;
    private ?int  $Ofertas_id;
    private ?int  $CantidadProducto;
    private ?int  $CantidadOferta;
    private ?int  $Mesa_id;

    /**
     * DetallePedidos constructor.
     * @param int|null $id
     * @param int $Factura_id
     * @param int|null $Producto_id
     * @param int|null $Ofertas_id
     * @param int|null $CantidadProducto
     * @param int|null $CantidadOferta
     * @param int|null $Mesa_id
     */
    public function __construct(array $detallePedido=[])
    {
        parent::__construct();
        $this->setId($detallePedido['id']?? null);
        $this->setFacturaId($detallePedido['Factura_id']?? null);
        $this->setProductoId($detallePedido['Producto_id']?? null);
        $this->setOfertasId($detallePedido['Ofertas_id']?? null);
        $this->setCantidadProducto($detallePedido['CantidadProducto']?? null);
        $this->setCantidadOferta($detallePedido['CantidadOferta']?? null);
        $this->setMesaId($detallePedido['Mesa_id']?? null);
    }

    public static function detallePedidoRegistrado(mixed $id, mixed $Factura_id)
    {
        $dteTmp = DetallePedidos::search("SELECT * FROM detallepedido WHERE id ='$id' and Factura_id ='$Factura_id'");
        return (!empty($dteTmp))? true : false;
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
     * @return int
     */
    public function getFacturaId(): int
    {
        return $this->Factura_id;
    }

    /**
     * @param int $Factura_id
     */
    public function setFacturaId(int $Factura_id): void
    {
        $this->Factura_id = $Factura_id;
    }

    /**
     * @return int|null
     */
    public function getProductoId(): ?int
    {
        return $this->Producto_id;
    }

    /**
     * @param int|null $Producto_id
     */
    public function setProductoId(?int $Producto_id): void
    {
        $this->Producto_id = $Producto_id;
    }

    /**
     * @return int|null
     */
    public function getOfertasId(): ?int
    {
        return $this->Ofertas_id;
    }

    /**
     * @param int|null $Ofertas_id
     */
    public function setOfertasId(?int $Ofertas_id): void
    {
        $this->Ofertas_id = $Ofertas_id;
    }

    /**
     * @return int|null
     */
    public function getCantidadProducto(): ?int
    {
        return $this->CantidadProducto;
    }

    /**
     * @param int|null $CantidadProducto
     */
    public function setCantidadProducto(?int $CantidadProducto): void
    {
        $this->CantidadProducto = $CantidadProducto;
    }

    /**
     * @return int|null
     */
    public function getCantidadOferta(): ?int
    {
        return $this->CantidadOferta;
    }

    /**
     * @param int|null $CantidadOferta
     */
    public function setCantidadOferta(?int $CantidadOferta): void
    {
        $this->CantidadOferta = $CantidadOferta;
    }

    /**
     * @return int|null
     */
    public function getMesaId(): ?int
    {
        return $this->Mesa_id;
    }

    /**
     * @param int|null $Mesa_id
     */
    public function setMesaId(?int $Mesa_id): void
    {
        $this->Mesa_id = $Mesa_id;
    }


    protected function save(string $query): ?bool
    {
        $arrData = [
                ':id' => $this->getId(),
                ':Factura_id' => $this->getFacturaId(),
                ':Producto_id' => $this->getProductoId(),
                ':Ofertas_id' => $this->getOfertasId(),
                ':CantidadProducto' => $this->getCantidadProducto(),
                ':CantidadOferta' => $this->getCantidadOferta(),
                ':Mesa_id' => $this->getMesaId(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }

    public function insert()
    {
        $query = "INSERT INTO detallepedido VALUES (
              :id, :Factura_id, :Producto_id, :Ofertas_id, :CantidadProducto,
              :CantidadOferta, :Mesa_id )";
        //return $this->save($query);
        if ($this->save($query)) {
            $idDetallePedido = $this->getLastId('detallepedido');
            $this->setId($idDetallePedido);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
            return true;
        }else{
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE detallepedido SET
            Factura_id = :Factura_id, Producto_id = :Producto_id, Ofertas_id = :Ofertas_id,
            CantidadProducto = :CantidadProducto, CantidadOferta = :CantidadOferta, 
            Mesa_id = :Mesa_id WHERE id =:id ";
        return $this->save($query);
    }

    public function deleted()
    {

    }

    static function search($query): ?array
    {
        try {
            $arrDetallePedidos = array();
            $tmp = new DetallePedidos();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $DetallePedido = new DetallePedidos($valor);
                    array_push($arrDetallePedidos, $DetallePedido);//aca meter el contenido del segundo parametro dentro del primero
                    unset($DetallePedido); //Borrar el contenido del objeto
                }
                return $arrDetallePedidos;
            }
            return null;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function searchForId(int $id): ?object
    {
        try {
            if ($id > 0) {
                $tmpDetallePedido = new DetallePedidos();
                $tmpDetallePedido->Connect();
                $getrow = $tmpDetallePedido->getRow("SELECT * FROM detallepedido WHERE id = ?", array($id) );

                $tmpDetallePedido->Disconnect();
                return ($getrow) ? new DetallePedidos($getrow) : null;
            } else {
                throw new \Exception('Id de detalle pedido Invalido');
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function getAll(): ?array
    {
        return DetallePedidos::search("SELECT * FROM detallepedido");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Factura_id' => $this->getFacturaId(),
            'Producto_id' => $this->getProductoId(),
            'Ofertas_id' => $this->getOfertasId(),
            'CantidadProducto' => $this->getCantidadProducto(),
            'CantidadOferta' => $this->getCantidadOferta(),
            'Mesa_id' => $this->getMesaId(),
        ];
    }
}