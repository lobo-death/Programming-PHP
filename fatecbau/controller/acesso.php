<?
	// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
	if (!empty($_REQUEST) AND (empty($_REQUEST['user']) OR empty($_REQUEST['pass']))) {
		header("Location: ../view/index.html"); 
		exit;
	}

	// as variáveis user e pass recebem os dados
	$user = mysql_real_escape_string($_REQUEST['user']);
	$pass = mysql_real_escape_string($_REQUEST['pass']);
	
	// arquivos das classes
	require_once("../model/DB.class.php");
	require_once("../model/Login.class.php");

	// cria objeto conectar do tipo DB para conexão ao banco de dados
	$conectar = new DB;
	$conectar = $conectar->conectar();

	// cria objeto logar do tipo Login para autenticar e criar sessão do usuário
	$logar = new Login;
	$logar = $logar->logar($user, $pass);
?>