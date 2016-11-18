<?
	class DB{
		public function conectar(){
			$host = "localhost";
			$user = "root";
			$pass = "";
			$dbname = "fatecbau";
			
			$conexao = mysql_connect($host, $user, $pass);
			$selectdb = mysql_select_db($dbname, $conexao);
			
			return $selectdb;
		}		
	}
?>