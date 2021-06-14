<?php


class ingenieroControl extends Controller{



    function __construct(){
        parent::__construct();
        if (!isset($_SESSION['codigo'])) {
            header('Location: ' . constant('URL') . 'loginControl');
            return;
        }
        $this->view->list = [];
        $this->view->data = [];
    }

    function render($ubicacion = null){
        $constr = "dashboard";
        $this->view->list = $this->model->listCita($_SESSION['codigo']);
        $this->view->data = $this->model->getData($_SESSION['codigo']);
        if(isset($ubicacion[0])){
            $this->view->render($constr , $ubicacion[0]);
        }else{
            $this->view->render($constr, 'ingeniero');}
    }

    function deleteCita($param = null){
        if($param==null)return;
        $id = $param[0];

        $data = $this->model->getDataId($id);
        $this->MensajeCorreoEliminar($data[0]['nombre'], $data[0]['start'],$data[0]['correo_institucional'],$data[0]['title']);
        $resp = $this->model->deleteCita($id);
        echo $resp;
    }

    function getCita(){
        $resp = $this->model->getCita();
        echo json_encode($resp);

    }

    function getHorario($param = null){
        $valor = array();
        $NuevaFecha = $param[0] . " " .  "08:00:00";
        $hora = $param[0] . " " .  "06:00:00";

        for ($i=0;$i<4;$i++) {

            $resp = $this->model->getHorario($NuevaFecha);
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
    }

    function editCita($param = null){
        if($param==null)return;
        $id = $param[0];
        $start = $param[1];
        $data = $this->model->getDataId($id);
        $this->MensajeCorreo($data[0]['nombre'], $data[0]['start'],$start,$data[0]['correo_institucional'],$data[0]['title']);
        $resp = $this->model->editCita($id,$start);
        echo $resp;
    }


    function MensajeCorreo($nombre, $cita1, $cita2, $correo, $titulo){
        $message  = "<html><body>";

        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";

        $message .= "<tr><td>";

        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";

        $message .= "<thead>
              <tr height='80'>
              <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Agenda de Citas</th>
              </tr>
                         </thead>";

        $message .= "<tbody>
                         <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
                   <td style='background-color:#00a2d1; text-align:center;'><a href='http://localhost/cita' style='color:#fff; text-decoration:none;'>Se ha realizado un cambio de citas(click aquí)</a></td>
                   </tr>
                  
                   <tr>
                   <td colspan='4' style='padding:15px;'>
                   <p style='font-size:20px;'>Hola,  " . $nombre . "</p>
                   <hr />    
                    <p style='font-size:20px; display: block'>Se realizo un cambio de la cita: " . $titulo  . "</p>
                      <p style='font-size:20px;display: block'>Paso de : " . $cita1  . "</p>
                        <p style='font-size:20px;display: block'>A la fecha: " . $cita2  . "</p>
                   </td>
                   </tr>
                  
                          </tbody>";

        $message .= "</table>";

        $message .= "</td></tr>";
        $message .= "</table>";

        $message .= "</body></html>";

        require_once "util/correo/Correo.php";
        $email = new Correo();
        $email->cargaCorreoCita($message, $correo);
        return;
    }

    function MensajeCorreoEliminar($nombre, $cita1, $correo, $titulo){
        $message  = "<html><body>";

        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";

        $message .= "<tr><td>";

        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";

        $message .= "<thead>
              <tr height='80'>
              <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Agenda de Citas</th>
              </tr>
                         </thead>";

        $message .= "<tbody>
                         <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
                   <td style='background-color:#00a2d1; text-align:center;'><a href='http://localhost/cita' style='color:#fff; text-decoration:none;'>Se ha realizado un cambio de citas(click aquí)</a></td>
                   </tr>
                  
                   <tr>
                   <td colspan='4' style='padding:15px;'>
                   <p style='font-size:20px;'>Hola,  " . $nombre . "</p>
                   <hr />    
                    <p style='font-size:20px; display: block'>Se realizo una eliminacion de la cita: " . $titulo  . "</p>
                      <p style='font-size:20px;display: block'>Programada en la fecha: " . $cita1  . "</p>
                   </td>
                   </tr>
                  
                          </tbody>";

        $message .= "</table>";

        $message .= "</td></tr>";
        $message .= "</table>";

        $message .= "</body></html>";

        require_once "util/correo/Correo.php";
        $email = new Correo();
        $email->cargaCorreoCita($message, $correo);
        return;
    }
}
?>