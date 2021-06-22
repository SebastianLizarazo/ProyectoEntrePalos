<?php


namespace App\Controllers;
use App\Models\GeneralFunctions;
use App\Models\Pagos;
use App\Models\SubCategorias;
use Carbon\Carbon;
use Carbon\Traits\Creator;

class PagosController
{
    private array $datapagos;

    public function __construct(array $_FORM) //Datos del formulario
    {
        $this->datapagos = array();
        $this->datapagos['id'] = $_FORM['id'] ?? NULL;
        $this->datapagos['Trabajador_id'] = $_FORM['Trabajador_id'] ?? NULL;
        $this->datapagos['Fecha'] = !empty($_FORM['Fecha']) ? Carbon::parse($_FORM['Fecha']) : new Carbon();
        $this->datapagos['ValorPago'] = $_FORM['ValorPago'] ?? NULL;
        $this->datapagos['Estado'] = $_FORM['Estado'] ?? 'Pendiente';
    }


    public function create()
    {
        try {
            if (!empty($this->datapagos['Trabajador_id']) && !empty($this->datapagos['Fecha']) && !Pagos::pagoRegistrado($this->datapagos['Trabajador_id'], $this->datapagos['Fecha'])) {
                $pago = new Pagos($this->datapagos);
                if ($pago->insert()) {
                    unset($_SESSION['frmCreatePago']);
                    header("Location: ../../views/modules/pago/index.php?respuesta=success&mensaje=Pago Registrado");
                }
            } else {
                header("Location: ../../views/modules/pago/create.php?respuesta=error&mensaje=Ya existe un pago con este trabajador y esta fecha a la vez");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }

    public function edit()
    {
        try {
            if (!Pagos::pagoRegistrado($this->datapagos['Trabajador_id'], $this->datapagos['Fecha'],$this->datapagos['id'])) {
                $pgs = new Pagos($this->datapagos);
                if ($pgs->update()) {
                    unset($_SESSION['frmEditPago']);
                }
                header("Location: ../../views/modules/pago/show.php?id=" . $pgs->getId() . "&respuesta=success&mensaje=Pago Actualizado");
            }else{
                header("Location: ../../views/modules/pago/edit.php?id=" . $this->datapagos['id'] . "&respuesta=error&mensaje=Ya existe un pago con este trabajador y esta fecha a la vez");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function activate(int $id)
    {
        try {
            $Objpago = Pagos::searchForId($id);
            $Objpago->setEstado("Saldado");
            if ($Objpago->update()) {
                header("Location: ../../views/modules/pago/index.php");
            } else {
                header("Location: ../../views/modules/pago/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }

    static public function inactivate(int $id)
    {
        try {
            $Objpago = Pagos::searchForId($id);
            $Objpago->setEstado("Pendiente");
            if ($Objpago->update()) {
                header("Location: ../../views/modules/pago/index.php");
            } else {
                header("Location: ../../views/modules/pago/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID(array $data)
    {
        try {
            $result = Pagos::searchForId($data['id']);
            if (!empty($data['request']) and $data['request'] === 'ajax' and !empty($result)) {
                header('Content-type: application/json; charset=utf-8');
                $result = json_encode($result->jsonSerialize());
            }
            return $result;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
        return null;
    }
    static public function getAll(array $data = null)
    {
        try {
            $result = Pagos::getAll();
            if (!empty($data['request']) and $data['request'] === 'ajax') {
                header('Content-type: application/json; charset=utf-8');
                $result = json_encode($result);
            }
            return $result;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
        return null;
    }
    static public function selectpago(array $params = []) {

        //Parametros de Configuracion
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "pago_id";
        $params['name'] = $params['name'] ?? "pago_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrPago = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM pago WHERE ";
            $arrPago = Pagos::search($base . ' ' . $params['where']);
        } else {
            $arrPago = Pagos::getAll();
        }
        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrPago) && count($arrPago) > 0) {
            /* @var $arrPago Pagos[] */
            foreach ($arrPago as $pago)
                if (!Pagoscontroller::pagoIsInArray($pago->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($pago != "") ? (($params['defaultValue'] == $pago->getId()) ? "selected" : "") : "") . " value='" . $pago->getId() . "'>" ."El pago numero: ". $pago->getId() . " Del trabajador: " . $pago->getTrabajador()->getNombres().
                        " Fecha: ".$pago->getFecha()->format('Y-m-d')."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function pagoIsInArray(int $idPagos, mixed $ArrPagos): ?bool
    {
        if (count($ArrPagos) > 0) {
            foreach ($ArrPagos as $pago) {
                if ($pago->getId() == $idPagos) {
                    return true;
                }
            }
        }
        return false;
    }
}