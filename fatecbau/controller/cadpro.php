<?  
	// Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['nome'])) OR (empty($_REQUEST['user'])) OR (empty($_REQUEST['pass'])) OR (empty($_REQUEST['word'])) OR (empty($_REQUEST['mail']))) {
        header("Location: ../view/index.html"); 
        exit;
    }
    
    // Verifica se senha e confirmação da senha são iguais
    if (($_REQUEST['pass']) != ($_REQUEST['word'])){
        header("Location: ../view/caduser.html"); 
        exit;
    }
	
	// Os atributos recebem os dados
	$id	  = mysql_real_escape_string($_REQUEST["id"]);
	$nome = mysql_real_escape_string($_REQUEST["nome"]);
	$user = mysql_real_escape_string($_REQUEST["user"]); 
	$pass = mysql_real_escape_string($_REQUEST["pass"]); 
	$word = mysql_real_escape_string($_REQUEST["word"]);
	$mail = mysql_real_escape_string($_REQUEST["mail"]);
	
	// arquivos das classes
	require_once("../model/DB.class.php");
	require_once("../model/Cadastro.class.php");

	// cria objeto conectar do tipo DB para conexão ao banco de dados
	$conectar = new DB;
	$conectar = $conectar->conectar();

	// cria objeto cadastro do tipo Cadastro para inserir novo usuário
	$cadastro = new Cadastro;
	$cadastro = $cadastro->cadpro($id, $nome, $user, $pass, $mail);
?>