<?php


namespace App\Models;

require ("AbstractDBConnection.php");//Importamos la clase padre
require (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require(__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;
use PhpParser\Node\Expr\Cast\Int_;

class Empresa
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private string $Nombre;
    private string $NIT;
    private int $Telefono;
    private string $Direccion;
    private string $Estado;
    private int $Municipio_id;

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
    public function __construct(?int $id, string $Nombre, string $NIT, int $Telefono, string $Direccion, string $Estado, int $Municipio_id)
    {
        $this->setId($Empresa['Id'] ?? 0);
        $this->setNombre($Empresa['Nombre'] ?? '');
        $this->setNIT($Empresa['NIT'] ?? '');
        $this->setTelefono($Empresa['Telefono'] ?? 0);
        $this->setDireccion($Empresa['Direccion'] ?? '');
        $this->setEstado($Empresa['Estado'] ?? '');
        $this->setMunicipioid($Empresa['Municipio_id'] ?? 0);
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

    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' => $this->getId(),
            ':Nombre' => $this->getNombre(),
            ':NIT' => $this->getNIT(),
            ':Telefono' => $this->getTelefono(),
            ':Direccion' => $this->getDireccion(),
            ':Estado' => $this->getEstado(),
            'Municipio_id:' => $this->getMunicipioid(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);//insertRow es el que inserta los datos que organiza el save
        $this->Disconnect();
        return $result;
    }

    public function insert(): ?bool
    {
        $query = "INSERT INTO Empresa VALUES (
            :id,:Nombre,:NIT,:Telefono,:Direccion,:Estado,:Municipio_id)";
        //return $this->save($query);
        if ($this->save($query)) {
            $idEmpresa = $this->getLastId('Empresa');
            $this->setId($idEmpresa);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
            return true;
        } else {
            return false;
        }
    }

    public function update(): ?bool
    {
        $query = "UPDATE Empresa SET 
            Nombre = :Nombre, NIT= :NIT, Telefono = :Telefono, Direccion = : Direccion, Estado = :Estado
            Municipio_id = :Municipio_id WHERE id = :id";
        return $this->save($query);

    }
    function deleted()
    {
        $this->setEstado("Activo");
        return $this->update();
    }


    static function search($query): ?array
    {
        try {
            $arrEmpresa = array();
            $tmp = new Empresa();

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
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function searchForId(int $id): ?Empresas
    {
        try {
            if ($id > 0) {
                $tmpEmpresa = new Empresas();
                $tmpEmpresa->Connect();
                $getrow = $tmpEmpresa->getRow("SELECT * FROM Empresas WHERE id = ?", array($id) );

                $tmpEmpresa->Disconnect();
                return ($getrow) ? new Empresa($getrow) : null;
            } else {
                throw new Exception('Id de usuario Invalido');
            }
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    static function getAll(): ?array
    {
        return Empresa::search("SELECT * FROM Empresa");
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