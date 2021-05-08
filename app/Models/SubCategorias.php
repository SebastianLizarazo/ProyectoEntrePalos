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
            Nombre = :Nombre,  CategoriaProducto= :CategoriaProducto, Estado = :Estado,
            WHERE id = :id";
        return $this->save($query);
    }

    function deleted()
    {
        // TODO: Implement deleted() method.
    }

    static function search($query): ?array
    {
        // TODO: Implement search() method.
    }

    static function searchForId(int $id): ?object
    {
        // TODO: Implement searchForId() method.
    }

    static function getAll(): ?array
    {
        // TODO: Implement getAll() method.
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}