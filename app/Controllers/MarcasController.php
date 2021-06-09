<?php


namespace App\Controllers;

use App\Models\GeneralFunctions;
use App\Models\Marcas;
use App\Models\SubCategorias;

class MarcasController
{
    private array $dataMarca;

    public function __construct(array $_FORM)
    {
        $this->dataMarca = array();
        $this->dataMarca['id'] = $_FORM['id'] ?? NULL;
        $this->dataMarca['Nombre'] = $_FORM['Nombre'] ?? NULL;
        $this->dataMarca['Descripcion'] = $_FORM['Descripcion'] ?? null;
        $this->dataMarca['Proveedor_id'] = $_FORM['Proveedor_id'] ?? NULL;
        $this->dataMarca['Estado'] = $_FORM['Estado'] ?? 'Activa';
    }

    public function create()
    {
        try {
            if (!empty($this->dataMarca['Nombre']) && !empty($this->dataMarca['Descripcion']) && !Marcas::marcaRegistrada($this->dataMarca['Nombre'], $this->dataMarca['Descripcion'])) {
                $Marca = new Marcas($this->dataMarca);
                if ($Marca->insert()) {
                    //unset($_SESSION['frmUsuarios']);
                    header("Location: ../../views/modules/marca/index.php?respuesta=success&mensaje=Marca Registrada");
                }
            } else {
                header("Location: ../../views/modules/marca/create.php?respuesta=error&mensaje=Marca ya registrada");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }
    static public function restaurar(int $id)
    {
        try {
            $ObjMarca = Marcas::searchForId($id);
            $ObjMarca->setEstado("Activa");
            if ($ObjMarca->update()) {
                header("Location: ../../views/modules/marca/restore.php?respuesta=success&mensaje=Marca restaurada");
            } else {
                header("Location: ../../views/modules/marca/restore.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate(int $id)
    {
        try {
            $ObjMarca = Marcas::searchForId($id);
            $ObjMarca->setEstado("Inactiva");
            if ($ObjMarca->update()) {
                header("Location: ../../views/modules/marca/index.php?respuesta=success&mensaje=Marca inactivada");
            } else {
                header("Location: ../../views/modules/marca/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    public function edit()
    {
        try {
            $mca = new Marcas($this->dataMarca);
            if ($mca->update()) {
                //unset($_SESSION['frmUsuarios']);
            }
            header("Location: ../../views/modules/marca/show.php?id=" . $mca->getId() . "&respuesta=success&mensaje=Marca Actualizada");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }

    static public function searchForID(array $data)
    {
        try {
            $result = Marcas::searchForId($data['id']);
            if (!empty($data['request']) and $data['request'] === 'ajax' and !empty($result)) {
                header('Content-type: application/json; charset=utf-8');
                $result = json_encode($result->jsonSerialize());
            }
            return $result;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
        return null;
    }

    static public function getAll(array $data = null)
    {
        try {
            $result = Marcas::getAll();
            if (!empty($data['request']) and $data['request'] === 'ajax') {
                header('Content-type: application/json; charset=utf-8');
                $result = json_encode($result);
            }
            return $result;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
        return null;
    }

    static public function selectMarca(array $params = [])
    {

        //Parametros de Configuracion
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "marca_id";
        $params['name'] = $params['name'] ?? "marca_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrMarcas = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM marca WHERE ";
            $arrMarcas = Marcas::search($base . ' ' . $params['where']);
        } else {
            $arrMarcas = Marcas::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrMarcas) && count($arrMarcas) > 0) {
            /* @var $arrMarcas Marcas[] */
            foreach ($arrMarcas as $marca)
                if (!MarcasController::marcaIsInArray($marca->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($marca != "") ? (($params['defaultValue'] == $marca->getId()) ? "selected" : "") : "") . " value='" . $marca->getId() . "'>" . "La marca numero: " . $marca->getNombre() . " Se llama: " . $marca->getDescripcion() . $marca->getProveedorId() . "El proveedor numero: " . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function marcaIsInArray($idMarca, $ArrMarcas): ?bool
    {
        if (count($ArrMarcas) > 0) {
            foreach ($ArrMarcas as $marca) {
                if ($marca->getId() == $idMarca) {
                    return true;
                }
            }
        }
        return false;
    }
}