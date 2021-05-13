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
        $this->dataFactura['IVA'] = $_FORM['IVA'] ?? NULL;
        $this->dataFactura['MedioPago'] = $_FORM['MedioPago'] ?? NULL;
        $this->dataFactura['Mesero_id'] = $_FORM['Mesero_id'] ?? NULL;
        $this->dataFactura['Estado'] = $_FORM['Estado'] ?? NULL;
        $this->dataFactura['TipoPedido'] = $_FORM['TipoPedido'] ?? Null;
    }

    public function create(){
        try {
            if (!empty($this->dataFactura['id']) && !empty($this->dataFactura['Numero']) && !Facturas::facturaRegistrada($this->dataFactura['id'], $this->dataFactura['Numero'])) {
                $Factura = new Facturas($this->dataFactura);
                if ($Factura->insert()) {
                    //unset($_SESSION['frmUsuarios']);
                    header("Location: ../../views/modules/factura/index.php?respuesta=success&mensaje=Factura Registrada");
                }
            } else {
                header("Location: ../../views/modules/factura/create.php?respuesta=error&mensaje=Factura ya registrada");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    public function edit()
    {
        try {
            $fta = new Facturas($this->dataFactura);
            if($fta->update()){
                //unset($_SESSION['frmUsuarios']);
            }
            header("Location: ../../views/modules/factura/show.php?id=" . $fta->getId() . "&respuesta=success&mensaje=Factura Actualizada");
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
}