<?php


namespace App\Models;


class Mesas
{
    private ?int $id;//el id es opcional porque el usuario no lo tiene que ingresar
    private int $Numero;
    private string $Ubicacion;
    private int $Capacidad;
    private string $Ocupacion;

    /**
     * Mesas constructor.
     * @param int|null $id
     * @param int $Numero
     * @param string $Ubicacion
     * @param int $Capacidad
     * @param string $Ocupacion
     */
    public function __construct(?int $id, int $Numero, string $Ubicacion, int $Capacidad, string $Ocupacion)
    {
        $this->setId() = $id;
        $this->setNumero() = $Numero;
        $this->setUbicacion() = $Ubicacion;
        $this->setCapacidad() = $Capacidad;
        $this->setOcupacion() = $Ocupacion;
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
     * @return int
     */
    public function getNumero(): int
    {
        return $this->Numero;
    }

    /**
     * @param int $Numero
     */
    public function setNumero(int $Numero): void
    {
        $this->Numero = $Numero;
    }

    /**
     * @return string
     */
    public function getUbicacion(): string
    {
        return $this->Ubicacion;
    }

    /**
     * @param string $Ubicacion
     */
    public function setUbicacion(string $Ubicacion): void
    {
        $this->Ubicacion = $Ubicacion;
    }

    /**
     * @return int
     */
    public function getCapacidad(): int
    {
        return $this->Capacidad;
    }

    /**
     * @param int $Capacidad
     */
    public function setCapacidad(int $Capacidad): void
    {
        $this->Capacidad = $Capacidad;
    }

    /**
     * @return string
     */
    public function getOcupacion(): string
    {
        return $this->Ocupacion;
    }

    /**
     * @param string $Ocupacion
     */
    public function setOcupacion(string $Ocupacion): void
    {
        $this->Ocupacion = $Ocupacion;
    }



}