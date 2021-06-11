<?php


namespace App\Controllers;

use App\Models\Imagenes;
use App\Models\GeneralFunctions;
class ImagenesController
{
    private array $dataImagen;

    /**
     * ImagenesController constructor.
     * @param array $dataImagen
     */
    public function __construct(array $_FORM)
    {
        $this->dataImagen = array();
        $this->dataImagen['id'] = $_FORM['id']?? null;
        $this->dataImagen['Nombre'] = $_FORM['Nombre']?? '';
        $this->dataImagen['Descripcion'] = $_FORM['Descripcion']?? '';
        $this->dataImagen['Ruta'] = $_FORM['Ruta']?? '';
        $this->dataImagen['Estado'] = $_FORM['Estado']?? 'Activo';
        $this->dataImagen['Producto_id'] = $_FORM['Producto_id']?? null;
        $this->dataImagen['Oferta_id'] = $_FORM['Oferta_id']?? null;
    }

     public function create($withFiles)
     {
         try {
             if (!empty($withFiles)) {
                 $imagenProducto = $withFiles['Imagen'];
                 $resultUpload = GeneralFunctions::subirArchivo($imagenProducto, "views/public/uploadFiles/photos/productos/");

                 if ($resultUpload != false){
                     $this->dataImagen['Ruta'] = $resultUpload;
                     $Imagen = new Imagenes($this->dataImagen);
                     if ($Imagen->insert()){
                         unset($_SESSION['frmImagenes']);
                         header("Location: ../../views/modules/imagen/index.php?respuesta=success&mensaje=Foto Creada Correctamente");
                     }
                 }
             }else{
                 GeneralFunctions::logFile('Error foto no encontrada');
                 header("Location:../../views/modules/imagen/create.php?respuesta=error&mensaje=Imagen no encontrada");
             }
         } catch (\Exception $e) {
             GeneralFunctions::logFile('Exception', $e, 'error');
         }
     }

     public function edit($withFiles = null)
     {
         try {
             if (!empty($withFiles)) {
                 $rutaImagen = $withFiles['Imagen'];
                 if ($rutaImagen['error'] == 0) { //Si la foto se selecciono correctamente
                     $resultUpload = GeneralFunctions::subirArchivo($rutaImagen, "views/public/uploadFiles/photos/productos/");
                     if ($resultUpload != false) {
                         GeneralFunctions::eliminarArchivo("views/public/uploadFiles/photos/productos/" . $this->dataImagen['Ruta']);
                         $this->dataImagen['Ruta'] = $resultUpload;
                     }
                 }
             }
             if (!empty($this->dataImagen['Ruta'])) {
                 $imagen = new Imagenes($this->dataImagen);
                 if ($imagen->update()) {
                     unset($_SESSION['frmImagenes']);
                 }
                 header("Location: ../../views/modules/imagen/show.php?id=" . $imagen->getId() . "&respuesta=success&mensaje=Imagen Actualizada");
             } else {
                 GeneralFunctions::logFile('Error Imagen Vaciá: ');
             }

         } catch (\Exception $e) {
             GeneralFunctions::logFile('Exception', $e, 'error');
         }
     }

     static public function searchForId(array $data)
     {
         try {
             $result = Imagenes::searchForId($data['id']);
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
             $result = Imagenes::getAll();
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

     static public function activate(int $id)
     {
         try {
             $ObjImagen = Imagenes::searchForId($id);
             $ObjImagen->setEstado("Activo");
             if ($ObjImagen->update()) {
                 header("Location: ../../views/modules/imagen/index.php");
             } else {
                 header("Location: ../../views/modules/imagen/index.php?respuesta=error&mensaje=Error al guardar");
             }
         } catch (\Exception $e) {
             GeneralFunctions::logFile('Exception',$e, 'error');
         }
     }

    static public function inactivate(int $id)
    {
        try {
            $ObjImagen = Imagenes::searchForId($id);
            $ObjImagen->setEstado("Inactivo");
            if ($ObjImagen->update()) {
                header("Location: ../../views/modules/imagen/index.php");
            } else {
                header("Location: ../../views/modules/imagen/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

     static public function selectImagen(array $param =[])
     {
         //Parametros de Configuracion
         $params['isMultiple'] = $params['isMultiple'] ?? false;
         $params['isRequired'] = $params['isRequired'] ?? true;
         $params['id'] = $params['id'] ?? "imagen_id";
         $params['name'] = $params['name'] ?? "imagen_id";
         $params['defaultValue'] = $params['defaultValue'] ?? "";
         $params['class'] = $params['class'] ?? "form-control";
         $params['where'] = $params['where'] ?? "";
         $params['arrExcluir'] = $params['arrExcluir'] ?? array(); //[Bebidas, Frutas]
         $params['request'] = $params['request'] ?? 'html';

         $arrImagenes = array();
         if ($params['where'] != "") {
             $base = "SELECT * FROM imagen WHERE ";
             $arrImagenes = Imagenes::search($base . ' ' . $params['where']);
         } else {
             $arrImagenes = Imagenes::getAll();
         }

         $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
         $htmlSelect .= "<option value='' >Seleccione</option>";
         if (is_array($arrImagenes) && count($arrImagenes) > 0) {
             /* @var $arrImagenes Imagenes[] */
             foreach ($arrImagenes as $imagen)
                 if (!ImagenesController::imagenIsInArray($imagen->getId(), $params['arrExcluir']))
                     $htmlSelect .= "<option " . (($imagen != "") ? (($params['defaultValue'] == $imagen->getId()) ? "selected" : "") : "") . " value='" . $imagen->getId() . "'>" ." La imagen: ". $imagen->getNombre(). "</option>";
         }
         $htmlSelect .= "</select>";
         return $htmlSelect;
     }

     private static function  imagenIsInArray($idImagen, $ArrImagenes): ?bool
     {
         if (count($ArrImagenes) > 0) {
             foreach ($ArrImagenes as $Imagen) {
                 if ($Imagen->getId() == $idImagen) {
                     return true;
                 }
             }
         }
         return false;
     }

}