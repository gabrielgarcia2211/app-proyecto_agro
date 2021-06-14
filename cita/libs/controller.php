<?php

class Controller{

    function __construct(){
        $this->view = new View();
    }

    function loadModel($model){
        $url = 'modelo/dao/'.$model.'Dao.php';

        if(file_exists($url)){
            require $url;

            $modelName = $model.'Dao';
            $this->model = new $modelName();
        }else{
            //echo $model;
        }
    }
}

?>