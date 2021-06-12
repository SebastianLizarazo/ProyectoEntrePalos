<?php


namespace App\Controllers;

use App\Models\GeneralFunctions;
use App\Models\Empresas;
class EmpresasController
{
    private array $dataEmpresa;//Almacenaran datos que vengan de la interfaz/vista

    public function __construct(array $_FORM) //Datos del formulario
    {
        $this->dataEmpresa = array();
        $this->dataEmpresa['id'] = $_FORM['id'] ?? NULL;
        $this->dataEmpresa['Nombre'] = $_FORM['Nombre'] ?? NULL;
        $this->dataEmpresa['NIT'] = $_FORM['NIT'] ?? null;
        $this->dataEmpresa['Telefono'] = $_FORM['Telefono'] ?? NULL;
        $this->dataEmpresa['Direccion'] = $_FORM['Direccion'] ?? NULL;
        $this->dataEmpresa['Estado'] = $_FORM['Estado'] ?? 'Activo';
        $this->dataEmpresa['Municipio_id'] = $_FORM['Municipio_id'] ?? NULL;

    }

    public function create()
    {
        try {
            if (!empty($this->dataEmpresa['Nombre']) && !empty($this->dataEmpresa['NIT']) && !empty($this->dataEmpresa['Telefono'])
                    && !Empresas::empresaRegistrada($this->dataEmpresa['Nombre'], $this->dataEmpresa['NIT'],$this->dataEmpresa['Telefono'])) {
                $Empresa = new Empresas($this->dataEmpresa);
                if ($Empresa->insert()) {
                    unset($_SESSION['frmCreateEmpresas']);
                    header("Location: ../../views/modules/empresa/index.php?respuesta=success&mensaje=Empresa Registrada");
                }
            } else {
                header("Location: ../../views/modules/empresa/create.php?respuesta=error&mensaje=Ya existe una empresa con este nombre, NIT o telefono");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }
    public function edit()
    {
        try {
            $Empresa = new Empresas($this->dataEmpresa);
            if($Empresa->update()){
                unset($_SESSION['frmEditEmpresas']);
            }
            header("Location: ../../views/modules/empresa/show.php?id=" . $Empresa->getId() . "&respuesta=success&mensaje=empresa Actualizada");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function searchForID(array $data)
    {
        try {
            $result = Empresas::searchForId($data['id']);
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
            $result = Empresas::getAll();
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
    static public function inactivate(int $id)
    {
        try {
            $ObjEmpresa = Empresas::searchForId($id);
            $ObjEmpresa->setEstado("Inactivo");
            if ($ObjEmpresa->update()) {
                header("Location: ../../views/modules/empresa/index.php?respuesta=success&mensaje=Empresa inhabilitado");
            } else {
                header("Location: ../../views/modules/empresa/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }

    static public function restaurar(int $id)
    {
        try {
            $ObjEmpresa = Empresas::searchForId($id);
            $ObjEmpresa->setEstado("Activo");
            if ($ObjEmpresa->update()) {
                header("Location: ../../views/modules/empresa/restore.php?respuesta=success&mensaje=Empresa restaurada");
            } else {
                header("Location: ../../views/modules/empresa/restore.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectEmpresa(array $params = []) {

        //Parametros de Configuracion
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "empresa_id";
        $params['name'] = $params['name'] ?? "empresa_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array(); //[Bebidas, Frutas]
        $params['request'] = $params['request'] ?? 'html';

        $arrEmpresa = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM empresa WHERE ";
            $arrEmpresas = Empresas::search($base . ' ' . $params['where']);
        } else {
            $arrEmpresas = Empresas::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrEmpresas) && count($arrEmpresas) > 0) {
            /* @var $arrEmpresas Empresas[] */
            foreach ($arrEmpresas as $empresa)
                if (!EmpresasController::empresaIsInArray($empresa->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($empresa != "") ? (($params['defaultValue'] == $empresa->getId()) ? "selected" : "") : "") . " value='" . $empresa->getId() . "'>" ."La empresa: ". $empresa->getNombre() . " con estado: " . $empresa->getEstado() . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function empresaIsInArray($idEmpresa, $ArrEmpresas): ?bool
    {
        if (count($ArrEmpresas) > 0) {
            foreach ($ArrEmpresas as $Empresa) {
                if ($Empresa->getId() == $idEmpresa) {
                    return true;
                }
            }
        }
        return false;
    }
}