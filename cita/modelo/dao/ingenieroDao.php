<?php


class ingenieroDao extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function getCita(){
        try{
            $codigo = $_SESSION["codigo"];
            $query = $this->db->connect()->prepare("SELECT * FROM servicio inner JOIN user_servicio ON user_servicio.id_servico =servicio.id INNER JOIN users ON users.codigo= user_servicio.codigo_ingeniero INNER JOIN cita c ON c.id_servicio = servicio.id WHERE users.codigo=$codigo");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function listCita($codigo){
        try{
            $statement = $this->db->connect()->prepare("SELECT * FROM servicio inner JOIN user_servicio ON user_servicio.id_servico =servicio.id INNER JOIN users ON users.codigo= user_servicio.codigo_ingeniero INNER JOIN cita c ON c.id_servicio = servicio.id WHERE users.codigo=$codigo");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
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

    function getDataId($id){
        try{
            $query = $this->db->connect()->prepare("SELECT * FROM users INNER JOIN personas ON users.documento = personas.documento INNER JOIN cita On cita.codigo=users.codigo where cita.id=$id");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function deleteCita($id){
        try{
            $query = $this->db->connect()->prepare('DELETE FROM cita WHERE id=:id');
            $query->execute([
                ':id' =>  $id ,
            ]);
            return true;
        }catch(PDOException $e){
            return $e->getMessage();
        }


    }

    public function getHorario($horario){
        try{
            $query = $this->db->connect()->prepare("SELECT start FROM servicio inner JOIN user_servicio ON user_servicio.id_servico =servicio.id INNER JOIN users ON users.codigo= user_servicio.codigo_ingeniero INNER JOIN cita c ON c.id_servicio = servicio.id where start LIKE '$horario%'");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }



    public function editCita($id, $start){

        try{
            $query = $this->db->connect()->prepare('UPDATE cita SET start= :start WHERE id=:id');
            $query->execute([
                ':id' =>  $id,
                ':start' => $start,
            ]);
            return true;
        }catch(PDOException $e){
            return $e->getMessage();
        }


    }



}