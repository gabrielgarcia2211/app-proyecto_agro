<?php

class userDto
{
    public $codigo;
    public $cedula;
    public $correo_institucional;
    public $rol;
    public $contraseña;

    /**
     * userDto constructor.
     * @param $codigo
     * @param $cedula
     * @param $correo_institucional
     * @param $rol
     * @param $contraseña
     */
    public function __construct($codigo, $cedula, $correo_institucional,  $contraseña)
    {
        $this->codigo = $codigo;
        $this->cedula = $cedula;
        $this->correo_institucional = $correo_institucional;
        $this->contraseña = $contraseña;
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
    public function getCorreoInstitucional()
    {
        return $this->correo_institucional;
    }

    /**
     * @param mixed $correo_institucional
     */
    public function setCorreoInstitucional($correo_institucional)
    {
        $this->correo_institucional = $correo_institucional;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed
     */
    public function getContraseña()
    {
        return $this->contraseña;
    }

    /**
     * @param mixed $contraseña
     */
    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;
    }




}