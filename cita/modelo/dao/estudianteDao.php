<?php

require 'modelo/dto/citaDto.php';
class estudianteDao extends Model{
    
    public function __construct(){
        parent::__construct();
      
       
    }
    public function getCita($codigo){
            try{
                $query = $this->db->connect()->prepare("SELECT * FROM cita INNER JOIN users ON cita.codigo=users.codigo WHERE users.codigo=$codigo");
                $query->execute();
                $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }catch(PDOException $e){
                return $e->getMessage();
            }
    }

    public function getCitaEstudiante($codigo){
        try{
            $query = $this->db->connect()->prepare("SELECT cita.title, cita.descripcion , cita.start, cita.end , servicio.descripcion as servicio FROM cita INNER JOIN servicio ON servicio.id=cita.id_servicio WHERE codigo=$codigo   ORDER BY start  ASC");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function addCita($codigo, $title, $descripcion, $color, $text, $start, $end, $servicio){
        $cita = new citaDto(0,$codigo, $title, $descripcion, $color, $text, $start, $end, $servicio);
        $query = $this->db->connect()->prepare("INSERT INTO cita(codigo, title, descripcion, color, textColor, start, end , id_servicio) VALUES (:codigo,:title,:descripcion,:color,:textColor, :start, :end ,:servicio)");
        try {
            $query->execute([
                ':codigo' =>  $cita->getCodigo() ,
                ':title' => $cita->getTitle(),
                ':descripcion' => $cita->getDescripcion() ,
                ':color' => $cita->getColor() ,
                ':textColor' => $cita->getTextColor(),
                ':start' => $cita->getStart(),
                ':end' => $cita->getEnd(),
                ':servicio' => $cita->getIdServicio()
            ]);
            $resultado = $query->fetchAll();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function editCita($id,$codigo, $title, $descripcion, $color, $text, $start, $end,$servicio){
        $cita = new citaDto($id,$codigo, $title, $descripcion, $color, $text, $start, $end, $servicio);
        try{
            $query = $this->db->connect()->prepare('UPDATE cita SET codigo = :codigo, title=:title , descripcion= :descripcion , color= :color , start= :start , textColor= :textColor, end= :end , id_servicio= :servicio WHERE id=:id');
            $query->execute([
                ':id' =>  $cita->getId() ,
                ':codigo' =>  $cita->getCodigo() ,
                ':title' => $cita->getTitle(),
                ':descripcion' => $cita->getDescripcion() ,
                ':color' => $cita->getColor() ,
                ':textColor' => $cita->getTextColor(),
                ':start' => $cita->getStart(),
                ':end' => $cita->getEnd(),
                ':servicio' => $cita->getIdServicio()
            ]);
            return true;
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

    public function getServicio(){
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM servicio');
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function getHorario($horario,$servicio){
        try{
           //$query = $this->db->connect()->prepare("SELECT start FROM cita where start LIKE '$horario%'");
            $query = $this->db->connect()->prepare("SELECT c.start FROM servicio  INNER JOIN cita c ON c.id_servicio = servicio.id WHERE c.start LIKE '$horario%' AND servicio.id=$servicio");
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




}

?>