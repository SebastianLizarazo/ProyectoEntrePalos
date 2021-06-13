<?php


namespace App\Controllers;
use App\Models\GeneralFunctions;
use App\Models\SubCategorias;

class SubCategoriasController
{

    private array $datasubcategoria;
        public function __construct(array $_FORM) //Datos del formulario
    {
        $this->datasubcategoria = array();
        $this->datasubcategoria['id'] = $_FORM['id'] ?? NULL;
        $this->datasubcategoria['Nombre'] = $_FORM['Nombre'] ?? NULL;
        $this->datasubcategoria['CategoriaProducto'] = $_FORM['CategoriaProducto'] ?? null;
        $this->datasubcategoria['Estado'] = $_FORM['Estado'] ?? 'Activo';
    }
    public function create()
    {
        try {
            if (!empty($this->datasubcategoria['Nombre']) && !empty($this->datasubcategoria['CategoriaProducto']) && !SubCategorias::subCategoriaRegistrada($this->datasubcategoria['Nombre'], $this->datasubcategoria['CategoriaProducto'])) {
                $subcategoria = new SubCategorias($this->datasubcategoria);
                if ($subcategoria->insert()) {
                    //unset($_SESSION['frmUsuarios']);
                    header("Location: ../../views/modules/subcategoria/index.php?respuesta=success&mensaje=subcategoria Registrada");
                }
            } else {
                header("Location: ../../views/modules/subcategoria/create.php?respuesta=error&mensaje=subcategoria ya registrada");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }
static public function activate(int $id)
{
    try {
        $Objsubcategoria = SubCategorias::searchForId($id);
        $Objsubcategoria->setEstado("Activo");
        if ($Objsubcategoria->update()) {
            header("Location: ../../views/modules/subcategoria/index.php");
        } else {
            header("Location: ../../views/modules/subcategoria/index.php?respuesta=error&mensaje=Error al guardar");
        }
    } catch (\Exception $e) {
        GeneralFunctions::logFile('Exception',$e, 'error');
    }
}

    static public function inactivate(int $id)
    {
        try {
            $Objsubcategoria = SubCategorias::searchForId($id);
            $Objsubcategoria->setEstado("Inactivo");
            if ($Objsubcategoria->update()) {
                header("Location: ../../views/modules/subcategoria/index.php");
            } else {
                header("Location: ../../views/modules/subcategoria/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    public function edit()
    {
        try {
            $sbc = new SubCategorias ($this->datasubcategoria);
            if($sbc->update()){
                //unset($_SESSION['frmUsuarios']);
            }
            header("Location: ../../views/modules/subcategoria/show.php?id=" . $sbc->getId() . "&respuesta=success&mensaje=SubCategoria Actualizada");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function searchForID(array $data)
    {
        try {
            $result = SubCategorias::searchForId($data['id']);
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
            $result = SubCategorias::getAll();
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
    static public function selectsubcategoria(array $params = []) {

        //Parametros de Configuracion
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "subcategoria_id";
        $params['name'] = $params['name'] ?? "subcategoria_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrSubCategoria = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM subcategoria WHERE ";
            $arrSubCategoria = SubCategorias::search($base . ' ' . $params['where']);
        } else {
            $arrSubCategoria = SubCategorias::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrSubCategoria) && count($arrSubCategoria) > 0) {
            /* @var $arrSubCategoria SubCategorias[] */
            foreach ($arrSubCategoria as $subcategoria)
                if (!SubCategoriascontroller::subcategoriaIsInArray($subcategoria->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($subcategoria != "") ? (($params['defaultValue'] == $subcategoria->getId()) ? "selected" : "") : "") . " value='" . $subcategoria->getId() . "'>". $subcategoria->getNombre() . " - " . $subcategoria->getCategoriaProducto() . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function subcategoriaIsInArray($idSubCategorias, $ArrSubcategorias): ?bool
    {
        if (count($ArrSubcategorias) > 0) {
            foreach ($ArrSubcategorias as $subcategoria) {
                if ($subcategoria->getId() == $idSubCategorias) {
                    return true;
                }
            }
        }
        return false;
    }
}