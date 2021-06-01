<?php

require("..\app\Models\Pagos.php");

use App\Models\Pagos;
use App\Models\Usuarios;
$arrPago = [

    'Trabajador_id' => 2,
    'Fecha' => '2021-03-02',
    'Estado' => 'Pendiente',
];

$arrPago2 = [
    'Trabajador_id' => 1,
    'Fecha' => '2021-01-05',
    'Estado' => 'Saldado',
];


$arrPago3 = [
    'Trabajador_id' => 3,
    'Fecha' => '2021-12-05',
    'Estado' => 'Pendiente',
];
//$objPago = new Pagos($arrPago); // Creamos un usuario... Pero no echo nada con el.
//$objPago->insert(); //Registramos el objeto en la base de datos

//$objPago->setTrabajadorId(3); //Cambio Valores
//$objPago->setFecha("2021-01-10"); //Cambio Valores
//$objPago->update();

//$objPago->deleted();


//$objPago2 = new Pagos($arrPago2);
//$objPago2->insert();

//$arrResult = Pagos::search("SELECT * FROM pago WHERE Trabajador_id = 3 ");
//if (!empty($arrResult)) {
  //  /* @var $arrResult Pagos[] */
    //foreach ($arrResult as $pagos) {
      //  echo "Numero de Trabajador: " . $pagos->getId() . " - " . $pagos->getTrabajadorId() . "\n";
    //}
//}
//$arrPago2 = Pagos::searchForId(1);
//if (!empty($arrPago2)) {
  //  $arrPago2->setEstado('Saldado');
    //$arrPago2->update();


//$arrPgs = Pagos::getAll();
//$arrPgs = Pagos::getAll();
//if (!empty($arrPgs)) {

  //  /* @var $arrPgs Pagos[] */
    //foreach ($arrPgs as $pagos) {
      //  echo "id: " . $pagos->getId() . "Numero del Trabajador: " . $pagos->getTrabajadorId() . ", Fecha: " . $pagos->getFecha() . ", Estado: " . $pagos->getEstado() . "\n";
    //}
//}
//$arrPago2 = Pagos::searchForId(5);
//echo json_encode($arrPago2);

//$objPago3= new Pagos( $arrPago3);
//var_dump($objPago3);
//$objPago3->insert();

//$pruebaPagoRegis= Pagos::pagoRegistrado('1',1);// Comprobamos que ya exista una marca con esas caracteristicas
//var_dump($pruebaPagoRegis);
$pruebausua= Usuarios::searchForId(1);

//echo "El trabajador ". $pruebausua->getNombres() ." Estado ". $pruebausua->getEstado() ." Pertenece al pago ". $pruebausua->getPagosTrabajador() ."\n";
print_r($pruebausua->getPagosTrabajador());

$pruebapag= Pagos::searchForId(1);

//echo "El trabajador ". $pruebausua->getNombres() ." Estado ". $pruebausua->getEstado() ." Pertenece al pago ". $pruebausua->getPagosTrabajador() ."\n";
print_r($pruebapag->getTrabajador());