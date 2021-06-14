<?php

require 'modelo/dto/personaDto.php';
require 'modelo/dto/userDto.php';
class loginDao extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function verificarUser($codigo, $documento, $contraseña){
        try{
            $statement = $this->db->connect()->prepare("SELECT codigo, documento, contraseña FROM users WHERE  codigo = :codigo AND documento = :documento AND contraseña = :contrasena ");
            $statement->execute(array(
                ':codigo' => $codigo,
                ':documento' => $documento,
                ':contrasena' => $contraseña
            ));
            $resultado = $statement->fetch();
            if(empty($resultado)){
                return false;
            }else{
                return true;
            }
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function traerRol($codigo){
        try{
            $statement = $this->db->connect()->prepare("SELECT rol FROM users WHERE  codigo = :codigo ");
            $statement->execute(array(
                ':codigo' => $codigo
            ));
            $resultado = $statement->fetch();
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function registroUser($nombre,$apellido,$cedula,$codigo,$correo_institucional,$correo_personal,$telefono, $contrasenia){
        $per = new personaDto($nombre, $apellido, $cedula, $correo_personal, $telefono);
        $user = new userDto($codigo, $cedula, $correo_institucional, $contrasenia);

        $query = $this->db->connect()->prepare("INSERT INTO personas(nombre, apellido, documento, correo, telefono) VALUES (:nombre, :apellido, :documento, :correo, :telefono)");
        $queryUser = $this->db->connect()->prepare("INSERT INTO users(codigo, correo_institucional, documento, contrasenia, rol) VALUES (:codigo, :correo_institucional, :documento, :contrasenia, :rol)");
        try {
            $query->execute([
                ':nombre' =>  $per->getNombre() ,
                ':apellido' => $per->getApellido(),
                ':documento' => $per->getCedula() ,
                ':correo' => $per->getCorreoPersonal() ,
                ':telefono' => $per->getTelefono()
            ]);
            $queryUser->execute([
                ':codigo' =>  $user->getCodigo() ,
                ':correo_institucional' => $user->getCorreoInstitucional(),
                ':documento' => $user->getCedula() ,
                ':contrasenia' => md5($user->getContraseña()) ,
                ':rol' => 3
            ]);
            return true;
        } catch (PDOException $e) {
    return $e->getMessage();
}
    }

}
