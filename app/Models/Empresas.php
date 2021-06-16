<?php


namespace App\Models;

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;
use PhpParser\Node\Expr\Cast\Int_;

class Empresas extends AbstractDBConnection implements Model
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private string $Nombre;
    private string $NIT;
    private int $Telefono;
    private string $Direccion;
    private string $Estado;
    private ?int $Municipio_id;

    /* Relaciones */
    private ?array $UsuariosEmpresa;

    /**
     * Empresa constructor.
     * @param int|null $id
     * @param string $Nombre
     * @param string $NIT
     * @param int $Telefono
     * @param string $Direccion
     * @param string $Estado
     * @param int $Municipio_id
     */


    public function __construct(array $Empresa=[])
    {
        parent::__construct();
        $this->setId($Empresa['id'] ?? 0);
        $this->setNombre($Empresa['Nombre'] ?? '');
        $this->setNIT($Empresa['NIT'] ?? '');
        $this->setTelefono($Empresa['Telefono'] ?? 0);
        $this->setDireccion($Empresa['Direccion'] ?? '');
        $this->setEstado($Empresa['Estado'] ?? '');
        $this->setMunicipioid($Empresa['Municipio_id'] ?? 0);
    }
    public static function empresaRegistrada(mixed $Nombre, mixed $NIT,mixed $Telefono,int $idExcluir = null): bool
    {
        $query = "SELECT * FROM empresa WHERE Nombre = '$Nombre' or NIT = '$NIT' or Telefono = '$Telefono'";
        $arrEmpresa = Empresas::search($query);
        if (!empty($arrEmpresa) && is_array($arrEmpresa)){
            if(count($arrEmpresa) > 1){
                return true;
            }elseif($arrEmpresa[0]->getId() != $idExcluir){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function __destruct()
    {
        //isConnected y Disconnect son metodos de la clase AbstractDBConnection
        if ($this->isConnected()){//pregunta si la base de datos esta conectada
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
     * @return string
     */
    public function getNombre(): string
    {
        return $this->Nombre;
    }

    /**
     * @param string $Nombre
     */
    public function setNombre(string $Nombre): void
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return string
     */
    public function getNIT(): string
    {
        return $this->NIT;
    }

    /**
     * @param string $NIT
     */
    public function setNIT(string $NIT): void
    {
        $this->NIT = $NIT;
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
    public function getMunicipioid(): int
    {
        return $this->Municipio_id;
    }

    /**
     * @param int $Municipio_id
     */
    public function setMunicipioid(int $Municipio_id): void
    {
        $this->Municipio_id = $Municipio_id;
    }

    public function getMunicipio(): ?Municipios
    {
        if (!empty($this->Municipio_id)) {
            return Municipios::searchForId($this->Municipio_id) ?? new Municipios();
        }
        return null;
    }

    public function getUsuariosEmpresa(): ?array
    {
        //if (!empty($this-> UsuariosEmpresa)) {
        $this-> UsuariosEmpresa = Usuarios::search(
            "SELECT * FROM usuario WHERE Empresa_id = ".$this->getId()
        );
        return ($this->UsuariosEmpresa)?? null;
        //}
        //return null;
    }

    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' => $this->getId(),
            ':Nombre' => $this->getNombre(),
            ':NIT' => $this->getNIT(),
            ':Telefono' => $this->getTelefono(),
            ':Direccion' => $this->getDireccion(),
            ':Estado' => $this->getEstado(),
            ':Municipio_id' => $this->getMunicipioid(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);//insertRow es el que inserta los datos que organiza el save
        $this->Disconnect();
        return $result;
    }

    public function insert(): ?bool
    {
        $query = "INSERT INTO empresa VALUES (
            :id,:Nombre,:NIT,:Telefono,:Direccion,:Estado,:Municipio_id)";
        //return $this->save($query);
        if ($this->save($query)) {
            $idEmpresa = $this->getLastId('empresa');
            $this->setId($idEmpresa);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
            return true;
        } else {
            return false;
        }
    }

    public function update(): ?bool
    {
        $query = "UPDATE empresa SET 
            Nombre = :Nombre, NIT = :NIT, Telefono = :Telefono, Direccion = :Direccion, Estado = :Estado,
            Municipio_id = :Municipio_id WHERE id = :id";
        return $this->save($query);

    }
    public function deleted(): ?bool
    {
        $this->setEstado("Inactivo");
        return $this->update();
    }


    public static function search($query): ?array
    {
        try {
            $arrEmpresa = array();
            $tmp = new Empresas();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $Empresa = new Empresas($valor);
                    array_push($arrEmpresa, $Empresa);//aca meter el contenido del segundo parametro dentro del primero
                    unset($Empresa); //Borrar el contenido del objeto
                }
                return $arrEmpresa;
            }
            return null;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function searchForId(int $id): ?Empresas
    {
        try {
            if ($id > 0) {
                $tmpEmpresa = new Empresas();
                $tmpEmpresa->Connect();
                $getrow = $tmpEmpresa->getRow("SELECT * FROM empresa WHERE id = ?", array($id) );

                $tmpEmpresa->Disconnect();
                return ($getrow) ? new Empresas($getrow) : null;
            } else {
                throw new \Exception('Id de empresa Invalido');
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function getAll(): ?array
    {
        return Empresas::search("SELECT * FROM empresa");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Nombre' =>$this->getNombre(),
            'NIT' =>$this->getNIT(),
            'Telefono' =>$this->getTelefono(),
            'Direccion' =>$this->getDireccion(),
            'Estado' =>$this->getEstado(),
            'Municipio_id' =>$this->getMunicipioid(),
        ];
    }

}