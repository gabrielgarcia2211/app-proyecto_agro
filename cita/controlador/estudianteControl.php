<?php
   

  class estudianteControl extends Controller{
      
        

      function __construct(){
         parent::__construct();
          if (!isset($_SESSION['codigo'])) {
              header('Location: ' . constant('URL') . 'loginControl');
              return;
          }
         $this->view->servicio = [];
         $this->view->horario = [];
         $this->view->cita = [];
         $this->view->data = [];
        
      }

      function render($ubicacion = null){
         $constr = "dashboard";
         $this->view->cita = $this->model->getCitaEstudiante($_SESSION['codigo']);
         $this->view->servicio = $this->model->getServicio();
         $this->view->data = $this->model->getData($_SESSION['codigo']);


         if(isset($ubicacion[0])){
             $this->view->render($constr , $ubicacion[0]);
         }else{
            $this->view->render($constr, 'index');}
      }

      function getCita(){
          $resp = $this->model->getCita($_SESSION['codigo']);
          echo json_encode($resp);

      }

      function addCita($param = null){
          if($param==null)return;

          $codigo = $_SESSION['codigo'];
          $title  = $param[0];
          $start = $param[1];
          $end = $param[1];
          $descripcion = $param[2];
          $color  = "#".$param[3];
          $text  = "#".$param[4];
          $servicio  = $param[5];

          $resp = $this->model->addCita($codigo,$title,$descripcion,$color,$text,$start,$end,$servicio);
          echo $resp;
      }

      function editCita($param = null){
          if($param==null)return;
          $id = $param[0];
          $codigo = $_SESSION['codigo'];
          $title  = $param[1];
          $start = $param[2];
          $end = $param[2];
          $descripcion = $param[3];
          $color  = "#".$param[4];
          $text  = "#".$param[5];
          $servicio  = $param[6];
          $resp = $this->model->editCita($id, $codigo,$title,$descripcion,$color,$text,$start,$end,$servicio);
          echo $resp;
      }

      function deleteCita($param = null){
          if($param==null)return;
          $id = $param[0];
          $resp = $this->model->deleteCita($id);
          echo $param[0];
      }

      function getHorario($param = null){
          $valor = array();
          $NuevaFecha = $param[0] . " " .  "08:00:00";
          $hora = $param[0] . " " .  "06:00:00";

          for ($i=0;$i<4;$i++) {

              $resp = $this->model->getHorario($NuevaFecha,$param[1]);
              $NuevaFecha = strtotime('2 hour', strtotime($NuevaFecha));
              $NuevaFecha =  date ( 'Y-m-d H:i:s' , $NuevaFecha);
              $hora = strtotime('2 hour', strtotime($hora));
              $hora =  date ( 'H:i:s' , $hora);
              if(empty($resp)){
                  $valor[$i] = $hora;
              }else{
                  $valor[$i] =  0;
              }

          }
          echo json_encode($valor);
          //echo $param[1];
      }





  }
?>