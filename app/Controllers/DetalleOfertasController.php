<?php


namespace App\Controllers;
use App\Models\GeneralFunctions;
use App\Models\DetalleOfertas;

class DetalleOfertasController
{
    private array $datadetalleOferta;//Almacenaran datos que vengan de la interfaz/vista

    public function __construct(array $_FORM) //Datos del formulario
    {
        $this->datadetalleOferta = array();
        $this->datadetalleOferta['id'] = $_FORM['id'] ?? NULL;
        $this->datadetalleOferta['Producto_id'] = $_FORM['Producto_id'] ?? NULL;
        $this->datadetalleOferta['Oferta_id'] = $_FORM['Oferta_id'] ?? NULL;
        $this->datadetalleOferta['CantidadProducto'] = $_FORM['CantidadProducto'] ?? NULL;
    }

    public function create()
    {
        try {
            if (!empty($this->datadetalleOferta['Producto_id']) && !empty($this->datadetalleOferta['Oferta_id']) && !DetalleOfertas::DetalleOfertaRegistrada($this->datadetalleOferta['Producto_id'], $this->datadetalleOferta['Oferta_id'])) {
                $DetalleOferta = new DetalleOfertas($this->datadetalleOferta);
                if ($DetalleOferta->insert()) {
                    //unset($_SESSION['frmUsuarios']);
                    header("Location: ../../views/modules/detalle_oferta/index.php?respuesta=success&mensaje=Detalle Oferta Registrada");
                }
            } else {
                header("Location: ../../views/modules/detalle_oferta/create.php?respuesta=error&mensaje=Detalle Oferta ya registrada");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }
    public function edit()
    {
        try {
            $dtlofta = new DetalleOfertas($this->datadetalleOferta);
            if($dtlofta->update()){
                //unset($_SESSION['frmUsuarios']);
            }
            header("Location: ../../views/modules/detalle_oferta/show.php?id=" . $dtlofta->getId() . "&respuesta=success&mensaje=Detalle Oferta Actualizada");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function searchForID(array $data)
    {
        try {
            $result = DetalleOfertas::searchForId($data['id']);
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
            $result = DetalleOfertas::getAll();
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
    static public function selectDetalleOferta(array $params = []) {

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

        $arrDetalleOferta = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM detalleoferta WHERE ";
            $arrDetalleOferta = DetalleOfertas::search($base . ' ' . $params['where']);
        } else {
            $arrDetalleOferta = DetalleOfertas::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrDetalleOferta) && count($arrDetalleOferta) > 0) {
            /* @var $arrDetalleOferta DetalleOfertas[] */
            foreach ($arrDetalleOferta as $detalleOferta)
                if (!DetalleOfertasController::detalleOfertaIsInArray($detalleOferta->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($detalleOferta != "") ? (($params['defaultValue'] == $detalleOferta->getId()) ? "selected" : "") : "") . " value='" . $detalleOferta->getId() . "'>" ."Detalle oferta con id producto: ". $detalleOferta->getProductoId() . " con cantidad de producto: " . $detalleOferta->getCantidadProducto() . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function detalleOfertaIsInArray($idDetalleOferta, $arrDetalleOferta): ?bool
    {
        if (count($arrDetalleOferta) > 0) {
            foreach ($arrDetalleOferta as $DetalleOferta) {
                if ($DetalleOferta->getId() == $idDetalleOferta) {
                    return true;
                }
            }
        }
        return false;
    }
}