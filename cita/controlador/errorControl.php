<?php
   

   class errorControl extends Controller{
        

        function __construct($ubicacion){
        
          parent::__construct();
          $constr = "error";
          $this->view->render($constr, $ubicacion);
          
        }    
   }

?>