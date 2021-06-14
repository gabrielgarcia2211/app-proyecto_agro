<?php
   

  class loginControl extends Controller{
      
        

        function __construct(){
          parent::__construct();
        
        }
                    
        function render($ubicacion = null){
          $constr = "login";
          if(isset($ubicacion[0])){
          $this->view->render($constr , $ubicacion[0]);
          }else{
           $this->view->render($constr, 'index');}
        }

        function validarDatos($param){
            if($param==null)return;
            $valor = array();
            $codigo = $param[0];
            $_SESSION["codigo"] = $codigo;
            $documento = $param[1];
            $contrasena = md5($param[2]);

            $valor[0] = $this->model->traerRol($_SESSION["codigo"]);
            $valor[1] = $this->model->verificarUser($codigo, $documento, $contrasena);
            echo json_encode($valor);
        }

      function cerrarSesionEstudiante(){
          unset($_SESSION['codigo']);
          session_destroy();
          header('Location: ' . constant('URL'). 'loginControl');
      }


      function registroData($param){
          if($param==null)return;
          $nombre = $param[0];
          $apellido = $param[1];
          $cedula = $param[2];
          $codigo = $param[3];
          $email = $param[4];
          $correo = $param[5];
          $telefono = $param[6];
          $password = $param[7];
          $valor = $this->model->registroUser($nombre, $apellido, $cedula,$codigo, $email, $correo,$telefono, $password);
          $_SESSION["codigo"] = $codigo;
          echo $valor;

      }




  }
?>