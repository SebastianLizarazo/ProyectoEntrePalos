<?php


namespace App\Models;

require_once("AbstractDBConnection.php");
require (__DIR__."\..\Interfaces\Model.php");
require(__DIR__ .'/../../vendor/autoload.php');

use App\Interfaces\Model;
use App\Models\AbstractDBConnection;


class Imagenes extends AbstractDBConnection implements Model
{
    private ?int $id;
    private string $Nombre;
    private string $Descripcion;
    private string $Ruta;
    private string $Estado;
    private int $Producto_id;
    private int $Oferta_id;

    /**
     * Imagenes constructor.
     * @param int|null Imagen* @param string $Nombre
     * @param string $Descripcion
     * @param string $Ruta
     * @param string $Estado
     * @param int $Producto_id
     * @param int $Oferta_id
     */
    public function __construct(array $imagen=[])
    {
        parent::__construct();
        $this->setid($imagen['id']?? null);
        $this->setNombre($imagen['Nombre']?? '');
        $this->setDescripcion($imagen['Descripcion']?? '');
        $this->setRuta($imagen['Ruta']??'' );
        $this->setEstado($imagen['Estado']?? '');
        $this->setProductoId($imagen['Producto_id']?? 0);
        $this->setOfertaId($imagen['Oferta_id']?? 0);
    }

    public static function imagenRegistrada(int $id, string $Ruta): bool
    {
        $imgTmp = Imagenes::search("SELECT * FROM imagen WHERE id = '$id' and Estado = '$Ruta'");
        return (!empty($imgTmp))? true : false;
    }

    public function __destruct()
    {
        if ($this->isConnected())
        {
            $this->Disconnect();
        }
    }


    /**
     * @return int|mixed|null
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param int|mixed|null $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getNombre(): mixed
    {
        return $this->Nombre;
    }

    /**
     * @param mixed|string $Nombre
     */
    public function setNombre(mixed $Nombre): void
    {
        $this->Nombre = $Nombre;
    }

    /**
     * @return mixed|string
     */
    public function getDescripcion(): mixed
    {
        return $this->Descripcion;
    }

    /**
     * @param mixed|string $Descripcion
     */
    public function setDescripcion(mixed $Descripcion): void
    {
        $this->Descripcion = $Descripcion;
    }

    /**
     * @return mixed|string
     */
    public function getRuta(): mixed
    {
        return $this->Ruta;
    }

    /**
     * @param mixed|string $Ruta
     */
    public function setRuta(mixed $Ruta): void
    {
        $this->Ruta = $Ruta;
    }

    /**
     * @return mixed|string
     */
    public function getEstado(): mixed
    {
        return $this->Estado;
    }

    /**
     * @param mixed|string $Estado
     */
    public function setEstado(mixed $Estado): void
    {
        $this->Estado = $Estado;
    }

    /**
     * @return int|mixed
     */
    public function getProductoId(): mixed
    {
        return $this->Producto_id;
    }

    /**
     * @param int|mixed $Producto_id
     */
    public function setProductoId(mixed $Producto_id): void
    {
        $this->Producto_id = $Producto_id;
    }

    /**
     * @return int|mixed
     */
    public function getOfertaId(): mixed
    {
        return $this->Oferta_id;
    }

    /**
     * @param int|mixed $Oferta_id
     */
    public function setOfertaId(mixed $Oferta_id): void
    {
        $this->Oferta_id = $Oferta_id;
    }


    protected function save(string $query): ?bool
    {
        $arrData = [
            ':id' => $this->getId(),
            ':Nombre' => $this->getNombre(),
            ':Descripcion' => $this->getDescripcion(),
            ':Ruta' => $this->getRuta(),
            ':Estado' => $this->getEstado(),
            ':Producto_id' => $this->getProductoId(),
            ':Oferta_id' => $this->getOfertaId(),
        ];
        $this->Connect();
        $result = $this->insertRow($query, $arrData);
        $this->Disconnect();
        return $result;
    }


    public function insert():?bool
    {
        $query = "INSERT INTO imagen VALUES (
           :id,:Nombre,:Descripcion,:Ruta,:Estado,:Producto_id,:Oferta_id)";
        //return $this->save($query);
        if ($this->save($query)) {
            $idImagen = $this->getLastId('imagen');
            $this->setId($idImagen);//Aca cambiamos el Id del objeto por el ultimo Id de la tabla mesa
            return true;
        }else{
            return false;
        }
    }

    public function update():?bool
    {
        $query = "UPDATE imagen SET
        Nombre = :Nombre, Descripcion = :Descripcion, Ruta = :Ruta,Estado = :Estado,
        Producto_id = :Producto_id, Oferta_id = :Oferta_id WHERE id = :id";
        return $this->save($query);
    }

    public function deleted()
    {
        $this->setEstado('Inactivo');
        return $this->update();
    }

    public static function search($query): ?array
    {
        try {
            $arrImagenes = array();
            $tmp = new Imagenes();

            $tmp->Connect();
            $getrows = $tmp->getRows($query);
            $tmp->Disconnect();

            if (!empty($getrows)) {
                foreach ($getrows as $valor) {
                    $Imagen = new Imagenes($valor);
                    array_push($arrImagenes, $Imagen);
                    unset($Imagen); //Borrar el contenido del objeto
                }
                return $arrImagenes;
            }
            return null;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function searchForId(int $id): ?Imagenes
    {
        try {
            if ($id > 0) {
                $tmpImagen = new Imagenes();
                $tmpImagen->Connect();
                $getrow = $tmpImagen->getRow("SELECT * FROM imagen WHERE id = ?", array($id) );

                $tmpImagen->Disconnect();
                return ($getrow) ? new Imagenes($getrow) : null;
            } else {
                throw new \Exception('Id de imagen Invalido');
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception', $e);
        }
        return null;
    }

    public static function getAll(): ?array
    {
        return Imagenes::search("SELECT * FROM imagen");
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'Nombre' => $this->getNombre(),
            'Descripcion' => $this->getDescripcion(),
            'Ruta' => $this->getRuta(),
            'Estado' => $this->getEstado(),
            'Producto_id' => $this->getProductoId(),
            'Oferta_id' => $this->getOfertaId(),
        ];
    }
}