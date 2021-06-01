<?php


namespace App\Models;
require_once ("AbstractDBConnection.php");//Importamos la clase padre
require_once (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require_once (__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;
use Carbon\Carbon;
use Carbon\Traits\Creator;


class Pagos extends AbstractDBConnection implements Model
{
    private ?int $id;
    private int $Trabajador_id;
    private Carbon $Fecha;
    private string $Estado;

    /* Relaciones */
    private ?array $ConsumoTrabajadoresPago;


    public function __construct(array $Pago=[])
    {
        parent::__construct();
        $this->setId($Pago['id']?? null);
        $this->setTrabajadorId($Pago['Trabajador_id']?? 0);
        $this->setFecha(!empty($Pago['Fecha']) ?
            Carbon::parse($Pago['Fecha']) : new Carbon());
        $this->setEstado($Pago['Estado']?? 'Pendiente') ;
    }
    public static function pagoRegistrado(mixed $Trabajador_id, mixed $id): bool
    {
        $pgoTmp = Pagos::search("SELECT * FROM pago WHERE Trabajador_id = '$Trabajador_id' and id = '$id'");
        return (!empty($pgoTmp) ? true : false);
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
     * @return int|null
     */
    public function getTrabajadorId(): ?int
    {
        return $this->Trabajador_id;
    }

    /**
     * @param int|null $Trabajador_id
     */
    public function setTrabajadorId(?int $Trabajador_id): void
    {
        $this->Trabajador_id = $Trabajador_id;
    }

    /**
     * @return Carbon
     */
    public function getFecha(): Carbon
    {
        return $this->Fecha->locale('es');
    }

    /**
     * @param Carbon $Fecha
     */
    public function setFecha(Carbon $Fecha): void
    {
        $this->Fecha = $Fecha;
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

    public function getTrabajador(): ?Usuarios
    {
        if (!empty($this->Trabajador_id)){
            return Usuarios::searchForId($this->Trabajador_id)?? new Usuarios();
        }
        return null;
    }
    public function getConsumoTrabajadoresPago(): ?array
    {
        //if (!empty($this-> ConsumoTrabajadoresPago)) {
        $this-> ConsumoTrabajadoresPago = ConsumoTrabajadores::search(
            "SELECT * FROM consumotrabajador WHERE Pago_id = ".$this->getId()
        );
        return ($this->ConsumoTrabajadoresPago)?? null;
        //}
        //return null;
    }

    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' =>    $this->getId(),
            ':Trabajador_id' =>   $this->getTrabajadorId(),
            ':Fecha' =>   $this->getFecha()->toDateString(),
            ':Estado' =>   $this->getEstado(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }
    public function insert(): ?bool
    {
        $query = "INSERT INTO pago VALUES (
            :id,:Trabajador_id,:Fecha,:Estado)";
        if ($this->save($query)) {
            $idpago = $this->getLastId('pago');
            $this->setId($idpago);
            return true;
        }else{
            return false;
        }
    }
    public function update(): ?bool
    {
        $query = "UPDATE pago SET 
            Trabajador_id = :Trabajador_id,  Fecha= :Fecha, Estado = :Estado
            WHERE id = :id";
        return $this->save($query);
    }
    public function deleted()
    {
        $this->setEstado("Pendiente");
        return $this->update();
    }


    public static function search($query): ?array
    {
        try {
            $arrPagos = array();
            $tmp = new pagos();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $pago = new Pagos($valor);
                    array_push($arrPagos, $pago);
                    unset($pago);
                }
                return $arrPagos;
            }
            return null;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }
    public static function searchForId(int $id): ?Pagos
    {
        try {
            if ($id > 0) {
                $tmppgo = new Pagos();
                $tmppgo->Connect();
                $getrow = $tmppgo->getRow("SELECT * FROM pago WHERE id = ?", array($id) );

                $tmppgo->Disconnect();
                return ($getrow) ? new Pagos($getrow) : null;
            } else {
                throw new \Exception('Id de Pago Invalido');
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function getAll(): ?array
    {
        return Pagos::search("SELECT * FROM pago");
    }
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Trabajador_id' =>$this->getTrabajadorId(),
            'Fecha' =>$this->getFecha()->toDateString(),
            'Estado' =>$this->getEstado(),
        ];
    }
}