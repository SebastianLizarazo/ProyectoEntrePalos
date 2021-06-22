<?php


namespace App\Controllers;

use App\Models\GeneralFunctions;
use App\Models\Facturas;
use Carbon\Carbon;
use Carbon\Traits\Creator;

class FacturasController
{
    private array $dataFactura;


    public function __construct(array $_FORM)
    {
        $this->dataFactura = array();
        $this->dataFactura['id'] = $_FORM['id'] ?? NULL;
        $this->dataFactura['Numero'] = $_FORM['Numero'] ?? NULL;
        $this->dataFactura['Fecha'] = !empty($_FORM['Fecha']) ? Carbon::parse($_FORM['Fecha']) : new Carbon() ;
        $this->dataFactura['IVA'] = $_FORM['IVA'] ?? 0.19;
        $this->dataFactura['MedioPago'] = $_FORM['MedioPago'] ?? NULL;
        $this->dataFactura['Mesero_id'] = $_FORM['Mesero_id'] ?? NULL;
        $this->dataFactura['Estado'] = $_FORM['Estado'] ?? NULL;
        $this->dataFactura['TipoPedido'] = $_FORM['TipoPedido'] ?? Null;
    }


    public function create(){
        try {
            $Factura = new Facturas($this->dataFactura);
            if ($Factura->insert()) {
                unset($_SESSION['frmCreateFactura']);
                header("Location: ../../views/modules/factura/index.php?respuesta=success&mensaje=Factura Registrada");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    public function edit()
    {
        try {
            if (!Facturas::facturaRegistrada($this->dataFactura['Numero'],$this->dataFactura['id'])) {
                $fta = new Facturas($this->dataFactura);
                if($fta->update()){
                    unset($_SESSION['frmEditFactura']);
                }
                header("Location: ../../views/modules/factura/show.php?id=" . $fta->getId() . "&respuesta=success&mensaje=Factura Actualizada");
            } else {
                header("Location: ../../views/modules/factura/edit.php?id=" . $this->dataFactura['id'] . "&respuesta=error&mensaje=Ya existe una factura con este numero");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function searchForID(array $data)
    {
        try {
            $result = Facturas::searchForId($data['id']);
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
            $result = Facturas::getAll();
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

    static public function statusPendiente(int $id)
    {
        try {
            $ObjFactura = Facturas::searchForId($id);
            $ObjFactura->setEstado("Pendiente");
            if ($ObjFactura->update()){
                header("Location: ../../views/modules/factura/index.php");
            }else{
                header("Location: ../../views/modules/factura/index.php?respuesta=error&mensaje=Error al guardar");
            }
        }catch (\Exception $e){
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function statusPaga(int $id)
    {
        try {
            $ObjFactura = Facturas::searchForId($id);
            $ObjFactura->setEstado("Paga");
            if ($ObjFactura->update()){
                header("Location: ../../views/modules/factura/index.php");
            }else{
                header("Location: ../../views/modules/factura/index.php?respuesta=error&mensaje=Error al guardar");
            }
        }catch (\Exception $e){
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function statusCancelada(int $id)
    {
        try {
            $ObjFactura = Facturas::searchForId($id);
            $ObjFactura->setEstado("Cancelada");
            if ($ObjFactura->update()){
                header("Location: ../../views/modules/factura/index.php?respuesta=success&mensaje=Factura cancelada");
            }else{
                header("Location: ../../views/modules/factura/index.php?respuesta=error&mensaje=Error al guardar");
            }
        }catch (\Exception $e){
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function statusRestaurar(int $id)//Restaura una factura ques esta en la papelera
    {
        try {
            $ObjFactura = Facturas::searchForId($id);
            $ObjFactura->setEstado("Pendiente");
            if ($ObjFactura->update()){
                header("Location: ../../views/modules/factura/restore.php?respuesta=success&mensaje=Factura restaurada");
            }else{
                header("Location: ../../views/modules/factura/restore.php?respuesta=error&mensaje=Error al guardar");
            }
        }catch (\Exception $e){
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectFactura(array $params = []) {

        //Parametros de Configuracion
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "factura_id";
        $params['name'] = $params['name'] ?? "factura_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array(); //[Bebidas, Frutas]
        $params['request'] = $params['request'] ?? 'html';

        $arrFacturas = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM factura WHERE ";
            $arrFacturas = Facturas::search($base . ' ' . $params['where']);
        } else {
            $arrFacturas = Facturas::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrFacturas) && count($arrFacturas) > 0) {
            /* @var $arrFacturas Facturas[] */
            foreach ($arrFacturas as $factura)
                if (!FacturasController::facturaIsInArray($factura->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($factura != "") ? (($params['defaultValue'] == $factura->getId()) ? "selected" : "") : "") . " value='" . $factura->getId() . "'>"
                                                 . $factura->getNumero();

                                    "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function facturaIsInArray(?int $idFactura, mixed $ArrFacturas): ?bool
    {
        if (count($ArrFacturas) > 0) {
            foreach ($ArrFacturas as $Factura) {
                if ($Factura->getId() == $idFactura) {
                    return true;
                }
            }
        }
        return false;
    }

}