<?php


namespace App\Models;
require ("AbstractDBConnection.php");//Importamos la clase padre
require (__DIR__."\..\Interfaces\Model.php");//Importamos la interfaz Model por ahora
require(__DIR__ .'/../../vendor/autoload.php');//Importamos todas las clases de vendor por ahora

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;


class SubCategorias extends AbstractDBConnection implements Model
{
    private ?int $id;
    private string $Nombre;
    private string $CategoriaProducto;
    private string $Estado ;

    public function __construct(array $SubCategoria=[])
    {
        parent::__construct();
        $this->setId($SubCategoria['id']?? null);
        $this->setNombre($SubCategoria['Nombre']??'');
        $this->setCategoriaProducto($SubCategoria['CategoriaProducto']??'Comida');
        $this->setEstado($SubCategoria['Estado']?? 'Activo') ;
    }
    public static function subCategoriaRegistrada (mixed $Nombre, mixed $id): bool
    {
        $sbcTmp = SubCategorias::search("SELECT * FROM subcategoria WHERE Nombre = '$Nombre' and id = '$id'");
        return (!empty($sbcTmp)) ? true : false;
    }
    public function __destruct()
    {
        if ($this->isConnected()){
            $this->Disconnect();
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
    public function getCategoriaProducto(): string
    {
        return $this->CategoriaProducto;
    }

    /**
     * @param string $CategoriaProducto
     */
    public function setCategoriaProducto(string $CategoriaProducto): void
    {
        $this->CategoriaProducto = $CategoriaProducto;
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

    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' =>    $this->getId(),
            ':Nombre' =>   $this->getNombre(),
            ':CategoriaProducto' =>   $this->getCategoriaProducto(),
            ':Estado' =>   $this->getEstado(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }

    public function insert(): ?bool
    {
        $query = "INSERT INTO subcategoria VALUES (
            :id,:Nombre,:CategoriaProducto,:Estado)";
        if ($this->save($query)) {
            $idsubcatgoria = $this->getLastId('subcategoria');
            $this->setId($idsubcatgoria);
            return true;
        }else{
            return false;
        }
    }
    public function update(): ?bool
    {
        $query = "UPDATE subcategoria SET 
            Nombre = :Nombre,  CategoriaProducto= :CategoriaProducto, Estado = :Estado
            WHERE id = :id";
        return $this->save($query);
    }

    function deleted()
    {
        $this->setEstado("Inactivo");
        return $this->update();
    }


    static function search($query): ?array
    {
        try {
            $arrSubCategorias = array();
            $tmp = new SubCategorias();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $subcategoria = new SubCategorias($valor);
                    array_push($arrSubCategorias, $subcategoria);
                    unset($subcategoria);
                }
                return $arrSubCategorias;
            }
            return null;
        } catch (Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }
    static function searchForId(int $id): ?SubCategorias
    {
        try {
            if ($id > 0) {
                $tmpsubcategoria = new SubCategorias();
                $tmpsubcategoria->Connect();
                $getrow = $tmpsubcategoria->getRow("SELECT * FROM subcategoria WHERE id = ?", array($id) );

                $tmpsubcategoria->Disconnect();
                return ($getrow) ? new SubCategorias($getrow) : null;
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
    return SubCategorias::search("SELECT * FROM subcategoria");
}

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Nombre' =>$this->getNombre(),
            'CategoriaProducto' =>$this->getCategoriaProducto(),
            'Estado' =>$this->getEstado(),
        ];
    }
}