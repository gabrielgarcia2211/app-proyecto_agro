<?php

class servicioDto
{
    public $id;
    public $descripcion;

    /**
     * servicioDto constructor.
     * @param $id
     * @param $descripcion
     */
    public function __construct($id, $descripcion)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }




}