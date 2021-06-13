<?php


namespace App\Models;

require_once ("AbstractDBConnection.php");//Importamos la clase padre
require_once (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require_once (__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;
use phpDocumentor\Reflection\Types\Array_;
use PhpParser\Node\Expr\Cast\Int_;

class Usuarios extends AbstractDBConnection implements Model
{
    private ?int $id;
    private int $Cedula;
    private string $Nombres;
    private string $Apellidos;
    private int $Telefono;
    private string $Direccion;
    private ?string $Email;
    private ?string $Contrasena;
    private string $Rol;
    private string $Estado;
    private int $Empresa_id;

    /*Relaciones*/
    private ?array $FacturasMesero;
    private ?array $MarcasProveedor;
    private ?array $PagosTrabajador;

    /* Seguridad de contraseña*/
    const HASH = PASSWORD_DEFAULT;
    const COST = 10;
    /**
     * Usuarios constructor.
     * @param int|null $id
     * @param int $Cedula
     * @param string $Nombres
     * @param string $Apellidos
     * @param int $Telefono
     * @param string $Direccion
     * @param string $Email
     * @param string $Contrasena
     * @param string $Rol
     * @param string $Estado
     * @param int $Empresa_id
     */


    public function __construct(array $Usuario =[])
    {
        parent::__construct();
        $this->setId($Usuario['id'] ?? 0);
        $this->setCedula($Usuario['Cedula'] ?? 0);
        $this->setNombres($Usuario['Nombres'] ?? '');
        $this->setApellidos($Usuario['Apellidos'] ?? '');
        $this->setTelefono($Usuario['Telefono'] ?? 0);
        $this->setDireccion($Usuario['Direccion'] ?? '');
        $this->setEmail($Usuario['Email'] ?? '');
        $this->setContrasena($Usuario['Contrasena'] ?? '');
        $this->setRol($Usuario['Rol'] ?? '');
        $this->setEstado($Usuario['Estado'] ?? '');
        $this->setEmpresaId($Usuario['Empresa_id'] ?? 1);
    }


    public static function usuarioRegistrado(mixed $Cedula): bool
    {
        $usuTmp = Usuarios::search("SELECT * FROM usuario WHERE Cedula = '$Cedula'");
        return (!empty($usuTmp) ? true : false);
    }

    public function __destruct()
    {
        //isConnected y Disconnect son metodos de la clase AbstractDBConnection
        if ($this->isConnected()) {//pregunta si la base de datos esta conectada
            $this->Disconnect();//destruye la coneccion
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCedula(): int
    {
        return $this->Cedula;
    }

    /**
     * @param int $Cedula
     */
    public function setCedula(int $Cedula): void
    {
        $this->Cedula = $Cedula;
    }

    /**
     * @return string
     */
    public function getNombres(): string
    {
        return $this->Nombres;
    }

    /**
     * @param string $Nombres
     */
    public function setNombres(string $Nombres): void
    {
        $this->Nombres = $Nombres;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->Apellidos;
    }

    /**
     * @param string $Apellidos
     */
    public function setApellidos(string $Apellidos): void
    {
        $this->Apellidos = $Apellidos;
    }

    /**
     * @return int
     */
    public function getTelefono(): int
    {
        return $this->Telefono;
    }

    /**
     * @param int $Telefono
     */
    public function setTelefono(int $Telefono): void
    {
        $this->Telefono = $Telefono;
    }

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->Direccion;
    }

    /**
     * @param string $Direccion
     */
    public function setDireccion(string $Direccion): void
    {
        $this->Direccion = $Direccion;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->Email;
    }

    /**
     * @param string $Email
     */
    public function setEmail(string $Email): void
    {
        $this->Email = $Email;
    }

    /**
     * @return string
     */
    public function getContrasena(): string
    {
        return $this->Contrasena;
    }

    /**
     * @param string $Contrasena
     */
    public function setContrasena(string $Contrasena): void
    {
        $this->Contrasena = $Contrasena;
    }

    /**
     * @return string
     */
    public function getRol(): string
    {
        return $this->Rol;
    }

    /**
     * @param string $Rol
     */
    public function setRol(string $Rol): void
    {
        $this->Rol = $Rol;
    }

    /**
     * @return string
     */
    public function getEstado(): string
    {
        return $this->Estado;
    }

    /**
     * @param string $Estado
     */
    public function setEstado(string $Estado): void
    {
        $this->Estado = $Estado;
    }

    /**
     * @return int
     */
    public function getEmpresaId(): int
    {
        return $this->Empresa_id;
    }

    /**
     * @param int $Empresa_id
     */
    public function setEmpresaId(int $Empresa_id): void
    {
        $this->Empresa_id = $Empresa_id;
    }

    public function getEmpresas(): ?Empresas
    {
        if (!empty($this->Empresa_id)) {
            return Empresas::searchForId($this->Empresa_id) ?? new Empresas();
        }
        return null;
    }
    public function getFacturasMesero(): ?array
    {
        if (!empty($this->FacturasMesero)){
            $this->FacturasMesero = Facturas::search(
                "SELECT * FROM factura WHERE Mesero_id =".$this->getId()
            );
            return ($this->FacturasMesero)?? null;
        }
        return null;
    }

    public function getMarcasProveedor(): ?array
    {
        if (!empty($this->MarcasProveedor)){
            $this->MarcasProveedor = Marcas::search(
              "SELECT * FROM marca WHERE Proveedor_id =".$this->getId()
            );
            return ($this->MarcasProveedor)?? null;
        }
        return null;
    }

    public function getPagosTrabajador(): ?array
    {
        if (!empty($this->PagosProveedor)){
            $this->PagosTrabajador = Pagos::search(
                "SELECT * FROM pago WHERE Trabajador_id =".$this->getId()
            );
            return ($this->PagosTrabajador)?? null;
        }
        return null;
    }
    protected function save(string $query): ?bool
    {
        $hashPassword = password_hash($this->Contrasena, self::HASH, ['cost' =>self::COST]);//Encripta la contraseña del ususario

        $arrData = [
            ':id' => $this->getId(),
            ':Cedula' => $this->getCedula(),
            ':Nombres' => $this->getNombres(),
            ':Apellidos' => $this->getApellidos(),
            ':Telefono' => $this->getTelefono(),
            ':Direccion' => $this->getDireccion(),
            ':Email' => $this->getEmail(),
            ':Contrasena' => $hashPassword,//Asigna la contraseña encriptada
            ':Rol' => $this->getRol(),
            ':Estado' => $this->getEstado(),
            ':Empresa_id' => $this->getEmpresaId(),
        ];

        $this->Connect();
        $result = $this->insertRow($query, $arrData);//insertRow es el que inserta los datos que organiza el save
        $this->Disconnect();
        return $result;
    }

    public function insert(): ?bool
    {
        $query = "INSERT INTO usuario VALUES (
            :id,:Cedula,:Nombres,:Apellidos,:Telefono,:Direccion,:Email,:Contrasena,:Rol,:Estado,:Empresa_id)";
        if ($this->save($query)) {
            $idUsuario = $this->getLastId('Usuario');
            $this->setId($idUsuario);
            return true;
        } else {
            return false;
        }
    }

    public function update(): ?bool
    {
        $query = "UPDATE usuario SET 
            Cedula =:Cedula, Nombres = :Nombres, Apellidos = :Apellidos, Telefono = :Telefono, Direccion = :Direccion, Email = :Email, 
            Contrasena = :Contrasena, Rol = :Rol, Estado = :Estado, Empresa_id = :Empresa_id WHERE id = :id";
        return $this->save($query);

    }

    public function deleted(): ?bool
    {
        $this->setEstado('Inactivo');
        return $this->update();
    }


    public static function search($query): ?array
    {
        try {
            $arrUsuario = array();
            $tmp = new Usuarios();
            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $Usuario = new Usuarios($valor);
                    array_push($arrUsuario, $Usuario);//aca meter el contenido del segundo parametro dentro del primero
                    unset($Usuario); //Borrar el contenido del objeto
                }
                return $arrUsuario;
            }
            return null;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function searchForId(int $id): ?Usuarios
    {
        try {
            if ($id > 0) {
                $tmpUsuario = new Usuarios();
                $tmpUsuario->Connect();
                $getrow = $tmpUsuario->getRow("SELECT * FROM usuario WHERE id = ?", array($id));

                $tmpUsuario->Disconnect();
                return ($getrow) ? new Usuarios($getrow) : null;
            } else {
                throw new \Exception('Id de usuario Invalido');
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function getAll(): ?array
    {
        return Usuarios::search("SELECT * FROM usuario");
    }

    public function login($Email, $Constrasena): Usuarios|String|null//si no retorna un objeto usuario retornara un string
    {
        try {
            $resultUsuarios = Usuarios::search("SELECT * FROM usuario WHERE Email = '$Email'");
            /* @var $resultUsuarios Usuarios[] */
            if (!empty($resultUsuarios) && count($resultUsuarios) >= 1) {
                if (password_verify($Constrasena, $resultUsuarios[0]->getContrasena())) {
                    if ($resultUsuarios[0]->getEstado() == 'Activo') {
                        return $resultUsuarios[0];
                    } else {
                        return "Usuario Inactivo";
                    }
                } else {
                    return "Contraseña Incorrecta";
                }
            } else {
                return "Usuario Incorrecto";
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
            return "Error en Servidor";
        }
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Cedula' => $this->getCedula(),
            'Nombres' => $this->getNombres(),
            'Apellidos' => $this->getApellidos(),
            'Telefono' => $this->getTelefono(),
            'Direccion' => $this->getDireccion(),
            'Email' => $this->getEmail(),
            'Contrasena' => $this->getContrasena(),
            'Rol' => $this->getRol(),
            'Estado' => $this->getEstado(),
            'Empresa_id' => $this->getEmpresaId()
        ];
    }

}