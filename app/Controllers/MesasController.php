<?php


namespace App\Controllers;

use App\Models\GeneralFunctions;
use App\Models\Mesas;
class MesasController
{
    private array $dataMesa;//Almacenaran datos que vengan de la interfaz/vista

    public function __construct(array $_FORM) //Datos del formulario
    {
        $this->dataMesa = array();
        $this->dataMesa['id'] = $_FORM['id'] ?? NULL;
        $this->dataMesa['Numero'] = $_FORM['Numero'] ?? NULL;
        $this->dataMesa['Ubicacion'] = $_FORM['Ubicacion'] ?? null;
        $this->dataMesa['Capacidad'] = $_FORM['Capacidad'] ?? NULL;
        $this->dataMesa['Ocupacion'] = $_FORM['Ocupacion'] ?? 'disponible';
    }
    public function create()
    {
        try {
            $Mesa = new Mesas($this->dataMesa);
            if ($Mesa->insert()) {
                unset($_SESSION['frmCreateMesa']);
                header("Location: ../../views/modules/mesa/index.php?respuesta=success&mensaje=Mesa Registrada");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }
    public function edit()
    {
        try {
            $oldMesa = Mesas::searchForId($this->dataMesa['id']);
            $this->dataMesa['Numero'] = $oldMesa->getNumero();
            unset($oldMesa);
            if (!Mesas::mesaRegistrada($this->dataMesa['Numero'], $this->dataMesa['id'])) {
                $msa = new Mesas($this->dataMesa);
                if ($msa->update()) {
                    unset($_SESSION['frmEditMesa']);
                }
                header("Location: ../../views/modules/mesa/show.php?id=" . $msa->getId() . "&respuesta=success&mensaje=Mesa Actualizada");
            }else{
                header("Location: ../../views/modules/mesa/edit.php?id=" . $this->dataMesa['id'] . "&respuesta=error&mensaje=Ya existe una mesa con este numero");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function searchForID(array $data)
    {
        try {
            $result = Mesas::searchForId($data['id']);
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
            $result = Mesas::getAll();
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

    static public function ocupar(int $id)
    {
        try {
            $ObjMesa = Mesas::searchForId($id);
            $ObjMesa->setOcupacion("ocupada");
            if ($ObjMesa->update()) {
                header("Location: ../../views/modules/mesa/index.php");
            } else {
                header("Location: ../../views/modules/mesa/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function liberar(int $id)
    {
        try {
            $ObjMesa = Mesas::searchForId($id);
            $ObjMesa->setOcupacion("Disponible");
            if ($ObjMesa->update()) {
                header("Location: ../../views/modules/mesa/index.php");
            } else {
                header("Location: ../../views/modules/mesa/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectMesa(array $params = []) {

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

        $arrMesas = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM mesa WHERE ";
            $arrMesas = Mesas::search($base . ' ' . $params['where']);
        } else {
            $arrMesas = Mesas::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        $htmlSelect .= "<option value='' >Domicilio</option>";
        if (is_array($arrMesas) && count($arrMesas) > 0) {
            /* @var $arrMesas Mesas[] */
            foreach ($arrMesas as $mesa)
                if (!MesasController::mesaIsInArray($mesa->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($mesa != "") ? (($params['defaultValue'] == $mesa->getId()) ? "selected" : "") : "") . " value='" . $mesa->getId() . "'>" . $mesa->getNumero() . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function mesaIsInArray($idMesa, $ArrMesas): ?bool
    {
        if (count($ArrMesas) > 0) {
            foreach ($ArrMesas as $Mesa) {
                if ($Mesa->getId() == $idMesa) {
                    return true;
                }
            }
        }
        return false;
    }
}