<?php
	/**
	 * esta clase se usa para operaciones de base de datos
	 */
	 
	 /**
	  * 
	  */ 
	
	class dbutils  {
		/*** la tabla a leer ***/
		public $table;
		function __construct() {
			
		}
		
	   public function conecta() {
	    /***esta funcion establece la conexion a sql***/
		/***variables de conexion ***/
		$mysql_hostname = "localhost";
		$mysql_user = "root";
		$mysql_password = "";
		$mysql_database = "sercum";


		$mysqli = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

		if($mysqli->connect_errno > 0){
		    die('No se establecio conexion a la base de datos [' . $mysqli->connect_error . ']');
			return -1;
		}else{ return $mysqli;}
		
	}
    
        public function checalogin($mysqli){
         //***checa si el cliente esta registrado ***/
            session_start();
    
            $user_check=$_SESSION['login_user'];
            
            $ses_sql=mysqli_query($mysqli,"select username from usuarios where username='$user_check' ");
            $empre = mysqli_query($mysqli,"select empresa from usuarios where username='$user_check' ");
            
            $row=mysqli_fetch_array($ses_sql);
            
            $login_session=$row['username'];
    
            if(!isset($login_session))
            {
                  header("Location: index.php"); 
               
            }
        }
        
        public function leetodos($mysqli,$table,$filtro='1'){
          //***lee todos los datos de una tabla, un registro o todos los registros, de acuerdo con el argumento $filtro ***/
            $sql= "SELECT * FROM $table WHERE ".$filtro;
            $result = mysqli_query($mysqli,$sql);
            $result2 = mysqli_fetch_row($result);
            /* liberar la serie de resultados */
                  mysqli_free_result($result);
                  /* cerrar la conexion */
                  mysqli_close($mysqli);
            if($result2){
              return $result2;  
            }
            else {
                 die('no hay resultados para '.$table);
            }
        }
		
		public function leeuno($mysqli,$table,$filtro){
          //***lee un registro de una tabla, un registro o todos los registros, de acuerdo con el argumento $filtro ***/
            $sql= "SELECT * FROM $table WHERE ".$filtro;
            $result = mysqli_query($mysqli,$sql);
            $result2 = mysqli_fetch_row($result);
            /* liberar la serie de resultados */
                  mysqli_free_result($result);
                  /* cerrar la conexion */
                  mysqli_close($mysqli);
            if($result2){
              return $result2;  
            }
            else {
                 die('no hay resultados para '.$table);
            }
        }
		
	
		
		
		
		
	
	}/*** fin de la clase ***/
	
	
	
?>