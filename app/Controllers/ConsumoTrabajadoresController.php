<?php


namespace App\Controllers;


use App\Models\ConsumoTrabajadores;
use App\Models\GeneralFunctions;
use App\Models\Mesas;

class ConsumoTrabajadoresController
{

    private array $dataConsumoTrabajador;//Almacenaran datos que vengan de la interfaz/vista

    public function __construct(array $_FORM) //Datos del formulario
    {
        $this->dataConsumoTrabajador = array();
        $this->dataConsumoTrabajador['id'] = $_FORM['id'] ?? NULL;
        $this->dataConsumoTrabajador['Pago_id'] = $_FORM['Pago_id'] ?? NULL;
        $this->dataConsumoTrabajador['Producto_id'] = $_FORM['Producto_id'] ?? null;
        $this->dataConsumoTrabajador['CantidadProducto'] = $_FORM['CantidadProducto'] ?? NULL;
        $this->dataConsumoTrabajador['Descripcion'] = $_FORM['Descripcion'] ?? 'disponible';
    }



    public function create()
    {
        try {
            if (!empty($this->dataConsumoTrabajador['Pago_id']) && !empty($this->dataConsumoTrabajador['Producto_id']) &&
                !ConsumoTrabajadores::consumoTrabajadorRegistrada($this->dataConsumoTrabajador['Pago_id'], $this->dataConsumoTrabajador['Producto_id'])){
                    $ConsumoTrabajador = new ConsumoTrabajadores($this->dataConsumoTrabajador);
                    if ($ConsumoTrabajador->insert()) {
                        unset($_SESSION['frmCreateConsumoTrabajador']);
                        header("Location: ../../views/modules/consumo_trabajador/index.php?respuesta=success&mensaje=Consumo Trabajador Registrado");
                    }
            } else {
                header("Location: ../../views/modules/consumo_trabajador/create.php?respuesta=error&mensaje=Ya existe un consumo trabajador con este pago y producto");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }
    public function edit()
    {
        try {
            if (!ConsumoTrabajadores::consumoTrabajadorRegistrada($this->dataConsumoTrabajador['Pago_id'], $this->dataConsumoTrabajador['Producto_id'],
                $this->dataConsumoTrabajador['id'])){
                $consumotbj = new ConsumoTrabajadores($this->dataConsumoTrabajador);
                if ($consumotbj->update()) {
                    unset($_SESSION['frmEditConsumoTrabajador']);
                }
                header("Location: ../../views/modules/consumo_trabajador/show.php?id=" . $consumotbj->getId() . "&respuesta=success&mensaje=Consumo Trabajdor Actualizado");
            }else{
                header("Location: ../../views/modules/consumo_trabajador/edit.php?id=" . $this->dataConsumoTrabajador['id'] . "&respuesta=error&mensaje=Ya existe un consumo trabajador con este pago y producto");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function searchForID(array $data)
    {
        try {
            $result = ConsumoTrabajadores::searchForId($data['id']);
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
            $result = ConsumoTrabajadores::getAll();
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
    static public function selectConsumoTrabajor(array $params = []) {

        //Parametros de Configuracion
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "mesa_id";
        $params['name'] = $params['name'] ?? "mesa_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array(); //[Bebidas, Frutas]
        $params['request'] = $params['request'] ?? 'html';

        $arrConsumoTrabajadores = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM consumotrabajador WHERE ";
            $arrConsumoTrabajadores = ConsumoTrabajadores::search($base . ' ' . $params['where']);
        } else {
            $arrConsumoTrabajadores = ConsumoTrabajadores::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrConsumoTrabajadores) && count($arrConsumoTrabajadores) > 0) {
            /* @var $arrConsumoTrabajadores ConsumoTrabajadores[] */
            foreach ($arrConsumoTrabajadores as $consumoTrabajador)
                if (!ConsumoTrabajadoresController::consumoTrabajadorIsInArray($consumoTrabajador->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($consumoTrabajador != "") ? (($params['defaultValue'] == $consumoTrabajador->getId()) ? "selected" : "") : "") . " value='" . $consumoTrabajador->getId() . "'>" ."La cantidad de consumo trabajador es: ". $consumoTrabajador->getCantidadProducto() . " y su descripcion es : " . $consumoTrabajador->getDescripcion() . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function consumoTrabajadorIsInArray($idConsumoTrabajador, $arrConsumoTrabajadores): ?bool
    {
        if (count($arrConsumoTrabajadores) > 0) {
            foreach ($arrConsumoTrabajadores as $ConsumoTrabajador) {
                if ($ConsumoTrabajador->getId() == $idConsumoTrabajador) {
                    return true;
                }
            }
        }
        return false;
    }
}