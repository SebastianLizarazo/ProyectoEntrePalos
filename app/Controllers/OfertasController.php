<?php


namespace App\Controllers;

use App\Models\GeneralFunctions;
use App\Models\Mesas;
use App\Models\Ofertas;

class OfertasController
{
    private array $dataOferta;//Almacenaran datos que vengan de la interfaz/vista

    public function __construct(array $_FORM) //Datos del formulario
    {
        $this->dataOferta = array();
        $this->dataOferta['id'] = $_FORM['id'] ?? NULL;
        $this->dataOferta['Nombre'] = $_FORM['Nombre'] ?? NULL;
        $this->dataOferta['Descripcion'] = $_FORM['Descripcion'] ?? null;
        $this->dataOferta['PrecioUnidadVentaOferta'] = $_FORM['PrecioUnidadVentaOferta'] ?? NULL;
        $this->dataOferta['Estado'] = $_FORM['Estado'] ?? 'Disponible';
    }



    public function create()
    {
        try {
            if (!empty($this->dataOferta['Nombre']) && !empty($this->dataOferta['Descripcion']) && !Ofertas::ofertaRegistrada($this->dataOferta['Nombre'], $this->dataOferta['Descripcion'])) {
                $Oferta = new Ofertas($this->dataOferta);
                if ($Oferta->insert()) {
                    //unset($_SESSION['frmUsuarios']);
                    header("Location: ../../views/modules/oferta/index.php?respuesta=success&mensaje=Oferta Registrada");
                }
            } else {
                header("Location: ../../views/modules/oferta/create.php?respuesta=error&mensaje=Oferta ya registrada");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }
    public function edit()
    {
        try {
            $ofta = new Ofertas($this->dataOferta);
            if($ofta->update()){
                //unset($_SESSION['frmUsuarios']);
            }
            header("Location: ../../views/modules/oferta/show.php?id=" . $ofta->getId() . "&respuesta=success&mensaje=Oferta Actualizada");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function searchForID (array $data)
    {
        try {
            $result = Ofertas::searchForId($data['id']);
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
    static public function getAll (array $data = null)
    {
        try {
            $result = Ofertas::getAll();
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
    static public function restaurar(int $id)
    {
        try {
            $ObjOferta = Ofertas::searchForId($id);
            $ObjOferta->setEstado("Disponible");
            if ($ObjOferta->update()) {
                header("Location: ../../views/modules/oferta/restore.php?respuesta=success&mensaje=Oferta restaurada");
            } else {
                header("Location: ../../views/modules/oferta/restore.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function inactivate(int $id)
    {
        try {
            $ObjOferta = Ofertas::searchForId($id);
            $ObjOferta->setEstado("No disponible");
            if ($ObjOferta->update()) {
                header("Location: ../../views/modules/oferta/index.php?respuesta=success&mensaje=Oferta deshabilitada");
            } else {
                header("Location: ../../views/modules/oferta/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectOferta(array $params = []) {

        //Parametros de Configuracion
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "oferta_id";
        $params['name'] = $params['name'] ?? "oferta_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array(); //[Bebidas, Frutas]
        $params['request'] = $params['request'] ?? 'html';

        $arrOfertas = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM oferta WHERE ";
            $arrOfertas = Ofertas::search($base . ' ' . $params['where']);
        } else {
            $arrOfertas = Ofertas::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrOfertas) && count($arrOfertas) > 0) {
            /* @var $arrOfertas Ofertas[] */
            foreach ($arrOfertas as $oferta)
                if (!OfertasController::ofertaIsInArray($oferta->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($oferta != "") ? (($params['defaultValue'] == $oferta->getId()) ? "selected" : "") : "") . " value='" . $oferta->getId() . "'>" ."El nombre de la oferta: ". $oferta->getNombre() . " con descripcion: " . $oferta->getDescripcion() . "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function OfertaIsInArray($idOferta, $ArrOferta): ?bool
    {
        if (count($ArrOferta) > 0) {
            foreach ($ArrOferta as $Oferta) {
                if ($Oferta->getId() == $idOferta) {
                    return true;
                }
            }
        }
        return false;
    }
}

