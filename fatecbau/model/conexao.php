<?
	function conexao(){
		// realiza a conexão com o servidor do Mysql
		$hostname	= "localhost";
		$usuario	= "root";
		$senha		= "";
		$conexao	= mysql_connect($hostname, $usuario, $senha) or die ("Erro conexão!");
		
		// seleciona no servidor, qual DB será usado
		$banco = "fatecbau";
		mysql_select_db($banco) or die ("Erro DB!");
		
		return $conexao;
	}
?>