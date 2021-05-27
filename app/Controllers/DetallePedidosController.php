<?php


namespace App\Controllers;

use App\Models\GeneralFunctions;
use App\Models\DetallePedidos;

class DetallePedidosController
{
    private array $dataDetallePedido;

    /**
     * DetallePedidosController constructor.
     * @param array $dataDetallePedido
     */
    public function __construct(array $_FORM)
    {
        $this->dataDetallePedido = array();
        $this->dataDetallePedido['id'] = $_FORM['id']?? null;
        $this->dataDetallePedido['Factura_id'] = $_FORM['Factura_id']?? null;
        $this->dataDetallePedido['Producto_id'] = $_FORM['Producto_id']?? null;
        $this->dataDetallePedido['Ofertas_id'] = $_FORM['Ofertas_id']?? null;
        $this->dataDetallePedido['CantidadProducto'] = $_FORM['CantidadProducto']?? null;
        $this->dataDetallePedido['CantidadOferta'] = $_FORM['CantidadOferta']?? null;
        $this->dataDetallePedido['Mesa_id'] = $_FORM['Mesa_id']?? null;
    }

    public function create()
    {
        try {
            if (!empty($this->dataDetallePedido['id']) && !empty($this->dataDetallePedido['Factura_id']) && !DetallePedidos::detallePedidoRegistrado($this->dataDetallePedido['id'], $this->dataDetallePedido['Factura_id'])) {
                $DetallePedido = new DetallePedidos($this->dataDetallePedido);
                if ($DetallePedido->insert()) {
                    //unset($_SESSION['frmUsuarios']);
                    header("Location: ../../views/modules/detallePedido/index.php?respuesta=success&mensaje=Detalle pedido Registrado");
                }
            } else {
                header("Location: ../../views/modules/detallePedido/create.php?respuesta=error&mensaje=Detalle pedido ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $dto = new DetallePedidos($this->dataDetallePedido);
            if($dto->update()){
                //unset($_SESSION['frmUsuarios']);
            }
            header("Location: ../../views/modules/detallePedido/show.php?id=" . $dto->getId() . "&respuesta=success&mensaje=Detalle pedido Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForId(array $data)
    {
        try {
            $result = DetallePedidos::searchForId($data['id']);
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

    static public function getAll()
    {
        try {
            $result = DetallePedidos::getAll();
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

    static public function selectDetallePedido(array $params=[])
    {
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "detallePedido_id";
        $params['name'] = $params['name'] ?? "detallePedido_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array(); //[Bebidas, Frutas]
        $params['request'] = $params['request'] ?? 'html';

        $arrDetallePedidos = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM detallepedido WHERE ";
            $arrDetallePedidos =  DetallePedidos::search($base . ' ' . $params['where']);
        } else {
            $arrDetallePedidos =  DetallePedidos::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrDetallePedidos) && count($arrDetallePedidos) > 0) {
            /* @var $arrDetallePedidos DetallePedidos[] */
            foreach ($arrDetallePedidos as $detallePedido)
                if (!DetallePedidosController::detallePedidoIsInArray($detallePedido->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($detallePedido != "") ? (($params['defaultValue'] == $detallePedido->getId()) ? "selected" : "") : "") . " value='" . $detallePedido->getId() . "'>".
                        "El detalle pedido de la factura: " . $detallePedido->getFacturaId().
                        "</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    private static function detallePedidoIsInArray(?int $idDetallePedido, mixed $ArrDetallePedidos)
    {
        if (count($ArrDetallePedidos) > 0){
            foreach ($ArrDetallePedidos as $DetallePedido){
                    if ($DetallePedido->getId() == $idDetallePedido){
                        return true;
                    }
            }
        }
    }
}