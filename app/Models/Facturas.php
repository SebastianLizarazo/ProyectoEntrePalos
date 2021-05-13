<?php



namespace App\Models;

require ("AbstractDBConnection.php");
require (__DIR__."\..\Interfaces\Model.php");
require (__DIR__.'/../../vendor/autoload.php');

use Carbon\Carbon;
use App\Interfaces\Model;
use App\Models\AbstractDBConnection;

class Facturas extends AbstractDBConnection implements Model
{
    private ?int $id;
    private  int $Numero;
    private  Carbon $Fecha;
    private  float $IVA;
    private  string $MedioPago;//Tener en cuenta que es un Enum
    private  int $Mesero_id;
    private  string $Estado;
    private  string $TipoPedido;

    /**
     * Facturas constructor.
     * @param int|null $id
     * @param int $Numero
     * @param Carbon $Fecha
     * @param float $IVA
     * @param string $MedioPago
     * @param int $Mesero_id
     * @param string $Estado
     * @param string $TipoPedido
     */
    public function __construct(array $factura=[])
    {

        $this->setId( $factura['id']?? null);
        $this->setNumero( $factura['Numero']?? 0);
        $this->setFecha(!empty($factura['Fecha'])? Carbon::parse($factura['Fecha']): new Carbon());
        $this->setIVA($factura['IVA']?? 0.0);
        $this->setMedioPago( $factura['MedioPago']?? '');
        $this->setMeseroId($factura['Mesero_id']?? 0);
        $this->setEstado( $factura['Estado']?? '');
        $this->setTipoPedido( $factura['TipoPedido']?? '');
    }

    public static function facturaRegistrada(mixed $id, mixed $Numero)
    {
        $ftaTmp = Facturas::search("SELECT * FROM factura WHERE id = '$id' and Numero = '$Numero'");
        return (!empty($ftaTmp))? true :false;
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
     * @return Carbon
     */
    public function getFecha(): Carbon
    {
        return $this->Fecha;
    }

    /**
     * @param Carbon $Fecha
     */
    public function setFecha(Carbon $Fecha): void
    {
        $this->Fecha = $Fecha;
    }

    /**
     * @return float
     */
    public function getIVA(): float
    {
        return $this->IVA;
    }

    /**
     * @param float $IVA
     */
    public function setIVA(float $IVA): void
    {
        $this->IVA = $IVA;
    }

    /**
     * @return string
     */
    public function getMedioPago(): string
    {
        return $this->MedioPago;
    }

    /**
     * @param string $MedioPago
     */
    public function setMedioPago(string $MedioPago): void
    {
        $this->MedioPago = $MedioPago;
    }

    /**
     * @return int
     */
    public function getMeseroId(): int
    {
        return $this->Mesero_id;
    }

    /**
     * @param int $Mesero_id
     */
    public function setMeseroId(int $Mesero_id): void
    {
        $this->Mesero_id = $Mesero_id;
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
     * @return string
     */
    public function getTipoPedido(): string
    {
        return $this->TipoPedido;
    }

    /**
     * @param string $TipoPedido
     */
    public function setTipoPedido(string $TipoPedido): void
    {
        $this->TipoPedido = $TipoPedido;
    }


    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' => $this->getId(),
            ':Numero' => $this->getNumero(),
            ':Fecha' => $this->getFecha(),
            ':IVA'   => $this->getIVA(),
            ':MedioPago'    => $this->getMedioPago(),
            ':Mesero_id'  => $this->getMeseroId(),
            ':Estado'   => $this->getEstado(),
            ':TipoPedido'   => $this->getTipoPedido(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }

    function insert()
    {
        $query = "INSERT INTO factura VALUES (
            :id,:Numero,:Fecha,:IVA,:MedioPago,:Mesero_id,:Estado,:TipoPedido)";
        if ($this->save($query)){
            $idFactura = $this->getLastId('factura');
            $this->setId($idFactura);
            return true;
        }else{
            return false;
        }
    }

    function update()
    {
        $query = "UPDATE factura SET
                Numero = :Numero,Fecha =:Fecha, IVA = :IVA, MedioPago = :MedioPago,
                Mesero_id = :Mesero_id, Estado = :Estado, TipoPedido = :TipoPedido WHERE id = :id";
        return $this->save($query);
    }

    /**
     * Preguntar al ingeniero como implementar el metodo delete en estos casos
     */
    function deleted()
    {

    }

    static function search($query): ?array
    {
        try {
            $arrFacturas = array();
            $tmp = new Facturas();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $Factura = new Mesas($valor);
                    array_push($arrFacturas, $Factura);//aca meter el contenido del segundo parametro dentro del primero
                    unset($Factura); //Borrar el contenido del objeto
                }
                return $arrFacturas;
            }
            return null;
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function searchForId(int $id): ?object
    {
        try {
            if ($id > 0) {
                $tmpFactura = new Facturas();
                $tmpFactura->Connect();
                $getrow = $tmpFactura->getRow("SELECT * FROM factura WHERE id = ?", array($id) );

                $tmpFactura->Disconnect();
                return ($getrow) ? new Facturas($getrow) : null;
            } else {
                throw new Exception('Id de factura Invalido');
            }
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function getAll(): ?array
    {
        return Facturas::search("SELECT * FORM factura");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Numero' => $this->getNumero(),
            'Fecha' => $this->getFecha(),
            'IVA' => $this->getIVA(),
            'MedioPago' => $this->getMedioPago(),
            'Mesero_Id' => $this->getMeseroId(),
            'Estado' => $this->getEstado(),
            'TipoPedido' => $this->getTipoPedido(),
        ];
    }
}