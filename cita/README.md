# proyectoredSocial

Las arquitecturas implementadas fueron FRONT CONTROLLER y MVC

El desarrollo de este proyecto se realizo mediante los lenguajes PHP 7.0, JavaScript con su libreria -> JQUERY, HTML, CSS
y como FRAMEWORK para dar estilos al CSS utilizamos bootstrap. Como administrador de base de datos MYSQL se utilizo PhpMyAmdin

La aplicacion esta en estado beta de desarollo por lo tanto la herramienta que utilizamos para realizarla fue XAMPP en nuestro 
ordenador, la cual trae una serie de componenetes como Apache Web Server Versión 2.4.41,   MySQL Database Versión 8.0.17, 
phpMyAdmin Database Manager Versión 4.9.1.

Descripcion de carpetas del aplicativo:



config -> se encuentra las variables estaticas globales que seran utilizadas a lo largo del aplicativo


controlador -> como su nombre lo indica, se encuentran los controladores del aplicativo, esta parte esta al pendiente de las peticiones realizadas por el usuario, ya sea mediante la URL o peticiones enviadas por AJAX a traves de los metodos POST O GET.


fotos -> en esta seccion se encuentra las fotos quese guardan por cada usuario del sistema, por ejemplo "usuario1" guardo una foto cualquiera, la base de datos se encarga de guardar la URL de la direccion donde se encuentra la imagen en la aplicacion y la iamgen queda almacenada en fotos/usuario1/namexximagen.


libs -> se puede concluir que son las clases padres encargadas de los metodos principales al momento de que el usuario hace una peticion mediante URL, alli entra hacer implementado FRONT CONTROLLER, la cual distribuye los parametros ingresados por URL ya sea hacia un controlador,metodo o parametro dentro de cada clase.


modelo -> se encuentran los dao (data access object) y los dto (data transfer object), son consultas y la representacion mediante objetos de cada tabla de la base de datos respectivamente.


public -> esta carpeta contiene una serie de subcarpeta que puede ser vista por el usuario atraves de su navegador. Se encuentra, CSS -- son los estilos dados a cada vista/html del aplicativo, FONT -- contiene iconos importados desde la pagina font awesome, ICON -- iconos estaticos utilizados a lo largo del aplicativo, JS -- javaScript con su libreria JQUERY que implementa AJAX para cosultas asincronas con la base de datos.


vista -> se encuentra cada vista llamada por el controlador, distribuida mediante carpetas que hacen referencia hacia su controlador, por ejemplo, vista/persona -> controlador/personaControl.


index-> archivo principal de ejecucion para el inicio del aplicativo, llama a las clases padres, que se encuentran en "libs".


redsocial.sql -> backup de la base de datos.

