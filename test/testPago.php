<?php

require("..\app\Models\Pagos.php");

use App\Models\Pagos;

$arrPago = [

    'Trabajador_id' => 2,
    'Fecha' => '2021-03-02',
    'Estado' => 'Pendiente',
];

$arrPago2 = [
    'Trabajador_id' => 5,
    'Fecha' => '2021-01-05',
    'Estado' => 'Saldado',
];
$objPago = new Pagos($arrPago); // Creamos un usuario... Pero no echo nada con el.
$objPago->insert(); //Registramos el objeto en la base de datos

$objPago->setTrabajadorId(4); //Cambio Valores
$objPago->setFecha("2021-01-10"); //Cambio Valores
$objPago->update();

$objPago->deleted();

$arrPago2 = new Pagos($arrPago2);
$arrPago2->insert();

$arrResult = Pagos::search("SELECT * FROM pago WHERE Trabajador_id = 4 ");
if (!empty($arrResult)) {
    /* @var $arrResult Pagos[] */
    foreach ($arrResult as $pagos) {
        echo "Numero de Trabajador: " . $pagos->getId() . " - " . $pagos->getTrabajadorId() . "\n";
    }
}
$arrPago2 = Pagos::searchForId(3);
if (!empty($arrPago2)) {
    $arrPago2->setEstado('Saldado');
    $arrPago2->update();
}

$arrPgs = Pagos::getAll();
$arrPgs = Pagos::getAll();
if (!empty($arrPgs)) {
    /* @var $arrPgs Pagos[] */
    foreach ($arrPgs as $pagos) {
        echo "id: " . $pagos->getId() . "Numero del Trabajador: " . $pagos->getTrabajadorId() . ", Fecha: " . $pagos->getFecha() . ", Estado: " . $pagos->getEstado() . "\n";
    }
}
$arrPago2 = Pagos::searchForId(5);
echo json_encode($arrPago2);