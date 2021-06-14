<?php

class personaDto
{
    public $nombre;
    public $apellido;
    public $cedula;
    public $correo_personal;
    public $telefono;

    /**
     * personaDto constructor.
     * @param $nombre
     * @param $apellido
     * @param $cedula
     * @param $correo_personal
     * @param $telefono
     */
    public function __construct($nombre, $apellido, $cedula, $correo_personal, $telefono)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->correo_personal = $correo_personal;
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @param mixed $cedula
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    /**
     * @return mixed
     */
    public function getCorreoPersonal()
    {
        return $this->correo_personal;
    }

    /**
     * @param mixed $correo_personal
     */
    public function setCorreoPersonal($correo_personal)
    {
        $this->correo_personal = $correo_personal;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }




}

