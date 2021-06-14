<?php

require 'modelo/dto/personaDto.php';
require 'modelo/dto/userDto.php';
require 'modelo/dto/servicioDto.php';

class adminDao extends Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function listCita(){
        try{
            $query = $this->db->connect()->prepare('SELECT u.codigo, u.correo_institucional, p.nombre, p.apellido, c.title, c.start, s.descripcion FROM users u INNER JOIN personas p ON u.documento=p.documento INNER JOIN cita c ON c.codigo=u.codigo INNER JOIN servicio s ON c.id_servicio=s.id');
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function getData($codigo){
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM users INNER JOIN personas ON users.documento = personas.documento where users.codigo=$codigo");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function addIngeniero($nombre,$apellido,$cedula,$codigo,$correo_institucional,$correo_personal,$telefono, $contrasenia){
        $ing = new personaDto($nombre, $apellido, $cedula, $correo_personal, $telefono);
        $user = new userDto($codigo, $cedula, $correo_institucional, $contrasenia);

        $query = $this->db->connect()->prepare("INSERT INTO personas(nombre, apellido, documento, correo, telefono) VALUES (:nombre, :apellido, :documento, :correo, :telefono)");
        $queryUser = $this->db->connect()->prepare("INSERT INTO users(codigo, correo_institucional, documento, contrasenia, rol) VALUES (:codigo, :correo_institucional, :documento, :contrasenia, :rol)");
        try {
            $query->execute([
                ':nombre' =>  $ing->getNombre() ,
                ':apellido' => $ing->getApellido(),
                ':documento' => $ing->getCedula() ,
                ':correo' => $ing->getCorreoPersonal() ,
                ':telefono' => $ing->getTelefono()
            ]);
            $queryUser->execute([
                ':codigo' =>  $user->getCodigo() ,
                ':correo_institucional' => $user->getCorreoInstitucional(),
                ':documento' => $user->getCedula() ,
                ':contrasenia' => $user->getContraseña() ,
                ':rol' => 2
            ]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function getIngeniero(){
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM users INNER JOIN personas ON users.documento = personas.documento WHERE users.rol=2");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function deleteIngeniero($codigo){
        try{
            $query = $this->db->connect()->prepare('DELETE personas.*  FROM users INNER JOIN personas ON users.documento=personas.documento WHERE users.codigo=:codigo');
            $query->execute([
                ':codigo' =>  $codigo ,
            ]);
            return true;
        }catch(PDOException $e){
            return $e->getMessage();
        }


    }

    function addServicio($nombre){
        $queryKey = $this->db->connect()->prepare("SELECT MAX(id) as id FROM servicio");
        $queryKey->execute();
        $key = $queryKey->fetchAll(PDO::FETCH_ASSOC);
        $find =  $key[0]["id"] + 1;
        $ser = new servicioDto($find,$nombre);
        $query = $this->db->connect()->prepare("INSERT INTO servicio(id, descripcion) VALUES (:id, :descripcion)");
        try {
            $query->execute([
                ':id' =>  $ser->getId() ,
                ':descripcion' => $ser->getDescripcion(),
            ]);
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($resultado)){
                if (strcmp($resultado[0]['descripcion'], $nombre) === 0){
                    return 0;
                }
            }
            return 1;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function getServicio(){
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM servicio");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function deleteServicio($codigo){
        try{
            $query = $this->db->connect()->prepare('DELETE  FROM servicio  WHERE id=:id');
            $query->execute([
                ':id' =>  $codigo ,
            ]);
            return true;
        }catch(PDOException $e){
            return $e->getMessage();
        }


    }

    function addVinculo($servicio,$ing){
        $query = $this->db->connect()->prepare("INSERT INTO user_servicio(id,codigo_ingeniero, id_servico) VALUES (:id, :codigo_ingeniero, :id_servicio)");
        try {
            $query->execute([
                ':id' => 0,
                ':codigo_ingeniero' =>  $ing ,
                ':id_servicio' => $servicio,
            ]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function getVinculo(){
        try{
            $query = $this->db->connect()->prepare("SELECT personas.nombre, personas.apellido, user_servicio.id , servicio.descripcion FROM users INNER JOIN user_servicio ON users.codigo = user_servicio.codigo_ingeniero INNER JOIN servicio ON servicio.id = user_servicio.id_servico INNER JOIN personas ON personas.documento = users.documento WHERE users.rol=2");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function deleteVinculo($codigo){
        try{
            $query = $this->db->connect()->prepare('DELETE FROM user_servicio  WHERE id=:id');
            $query->execute([
                ':id' =>  $codigo ,
            ]);
            return true;
        }catch(PDOException $e){
            return $e->getMessage();
        }


    }



}