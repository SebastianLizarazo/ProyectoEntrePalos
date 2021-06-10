<?php


namespace App\Controllers;

use App\Models\GeneralFunctions;
use App\Models\Pagos;
use App\Models\Usuarios;
class UsuariosController
{
    private array $dataUsuario;//Almacenaran datos que vengan de la interfaz/vista

    public function __construct(array $_FORM) //Datos del formulario
    {
        $this->dataUsuario = array();
        $this->dataUsuario['id'] = $_FORM['id'] ?? NULL;
        $this->dataUsuario['Cedula'] = $_FORM['Cedula'] ?? NULL;
        $this->dataUsuario['Nombres'] = $_FORM['Nombres'] ?? NULL;
        $this->dataUsuario['Apellidos'] = $_FORM['Apellidos'] ?? null;
        $this->dataUsuario['Telefono'] = $_FORM['Telefono'] ?? NULL;
        $this->dataUsuario['Direccion'] = $_FORM['Direccion'] ?? NULL;
        $this->dataUsuario['Email'] = $_FORM['Email'] ?? NULL;
        $this->dataUsuario['Contrasena'] = $_FORM['Contrasena'] ?? NULL;
        $this->dataUsuario['Rol'] = $_FORM['Rol'] ?? NULL;
        $this->dataUsuario['Estado'] = $_FORM['Estado'] ?? 'Activo';
        $this->dataUsuario['Empresa_id'] = $_FORM['Empresa_id'] ?? NULL;

    }



    public function create()
    {
        try {
            if (!empty($this->dataUsuario['Cedula']) && !empty($this->dataUsuario['Nombres']) && !Usuarios::UsuarioRegistrado($this->dataUsuario['Cedula'], $this->dataUsuario['Nombres'])) {
                $Usuario = new Usuarios($this->dataUsuario);
                if ($Usuario->insert()) {
                    unset($_SESSION['frmUsuarios']);
                    header("Location: ../../views/modules/usuario/index.php?respuesta=success&mensaje=Usuario Registrado");
                }
            } else {
                header("Location: ../../views/modules/usuario/create.php?respuesta=error&mensaje=Usuario ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }

    static public function inactivate(int $id)
    {
        try {
            $Obusuarios = Usuarios::searchForId($id);
            $Obusuarios->setEstado("Inactivo");
            if ($Obusuarios->update()) {
                header("Location: ../../views/modules/usuario/index.php?respuesta=success&mensaje=Usuario deshabilitado");
            } else {
                header("Location: ../../views/modules/usuario/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function restaurar(int $id)
    {
        try {
            $Obusuarios = Usuarios::searchForId($id);
            $Obusuarios->setEstado("Activo");
            if ($Obusuarios->update()) {
                header("Location: ../../views/modules/usuario/restore.php?respuesta=success&mensaje=Usuario restaurado");
            } else {
                header("Location: ../../views/modules/usuario/restore.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e, 'error');
        }
    }
    public function edit()
    {
        try {
            $Usuario = new Usuarios($this->dataUsuario);
            if($Usuario->update()){
                unset($_SESSION['frmUsuarios']);
            }
            header("Location: ../../views/modules/usuario/show.php?id=" . $Usuario->getId() . "&respuesta=success&mensaje=usuario Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    static public function searchForID(array $data)
    {
        try {
            $result = Usuarios::searchForId($data['id']);
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
            $result = Usuarios::getAll();
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
    static public function selectUsuario(array $params = []) {

        //Parametros de Configuracion
        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "usuario_id";
        $params['name'] = $params['name'] ?? "usuario_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array(); //[Bebidas, Frutas]
        $params['request'] = $params['request'] ?? 'html';

        $arrEmpresa = array();
        if ($params['where'] != "") {
            $base = "SELECT * FROM usuario WHERE ";
            $arrUsuarios = Usuarios::search($base . ' ' . $params['where']);
        } else {
            $arrUsuarios = Usuarios::getAll();
        }

        $htmlSelect = "<select " . (($params['isMultiple']) ? "multiple" : "") . " " . (($params['isRequired']) ? "required" : "") . " id= '" . $params['id'] . "' name='" . $params['name'] . "' class='" . $params['class'] . "' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if (is_array($arrUsuarios) && count($arrUsuarios) > 0) {
            /* @var $arrUsuarios Usuarios[] */
            foreach ($arrUsuarios as $usuario)
                if (!UsuariosController::usuarioIsInArray($usuario->getId(), $params['arrExcluir']))
                    $htmlSelect .= "<option " . (($usuario != "") ? (($params['defaultValue'] == $usuario->getId()) ? "selected" : "") : "") . " value='" . $usuario->getId() . "'>" ."El usuario: ". $usuario->getNombres() . " con estado: " . $usuario->getEstado() . "</option>";
        }

         $htmlSelect .= "</select>";
          return $htmlSelect;
          }
         private static function usuarioIsInArray($idUsuario, $ArrUsuarios): ?bool
        {
         if (count($ArrUsuarios) > 0) {
           foreach ($ArrUsuarios as $Usuario) {
            if ($Usuario->getId() == $idUsuario) {
                return true;
              }
          }
      }
       return false;
    }

    public static function login (){
        try {
            if(!empty($_POST['Email']) && !empty($_POST['Contrasena'])){
                $tmpUser = new Usuarios();
                $respuesta = $tmpUser->login($_POST['Email'], $_POST['Contrasena']);
                if (is_a($respuesta,"App\Models\Usuarios")) {
                    $_SESSION['UserInSession'] = $respuesta->jsonSerialize();
                    header("Location: ../../views/index.php");
                }else{
                    header("Location: ../../views/modules/site/login.php?respuesta=error&mensaje=".$respuesta);
                }
            }else{
                header("Location: ../../views/modules/site/login.php?respuesta=error&mensaje=Datos Vacíos");
            }
        } catch (\Exception $e) {
            header("Location: ../../views/modules/site/login.php?respuesta=error".$e->getMessage());
        }
    }

    public static function cerrarSession (){
        session_unset();
        session_destroy();
        header("Location: ../../views/modules/site/login.php");
    }
}