<?php

class citaDto
{
    public $id;
    public $codigo;
    public $title;
    public $descripcion;
    public $color;
    public $textColor;
    public $start;
    public $end;
    public $id_servicio;

    /**
     * citaDto constructor.
     * @param $id
     * @param $codigo
     * @param $title
     * @param $descripcion
     * @param $color
     * @param $textColor
     * @param $start
     * @param $end
     * @param $id_servicio
     */
    public function __construct($id, $codigo, $title, $descripcion, $color, $textColor, $start, $end, $id_servicio)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->title = $title;
        $this->descripcion = $descripcion;
        $this->color = $color;
        $this->textColor = $textColor;
        $this->start = $start;
        $this->end = $end;
        $this->id_servicio = $id_servicio;
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
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @param mixed $textColor
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @return mixed
     */
    public function getIdServicio()
    {
        return $this->id_servicio;
    }

    /**
     * @param mixed $id_servicio
     */
    public function setIdServicio($id_servicio)
    {
        $this->id_servicio = $id_servicio;
    }




}

