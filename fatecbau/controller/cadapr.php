<?	
    // Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['apre']))) {
        header("Location: ../view/menu.php"); 
        exit;
    }
    
    $id		= $_REQUEST['id'];
	$nome	= $_REQUEST['apre'];
		
	require_once("../model/conexao.php");
	require_once("../model/Cadastro.class.php");
	require_once("../model/DB.class.php");
	
	// Conexão com o banco de dados	
	$conectar = new DB;
	$conectar = $conectar->conectar();
	
	$conectar = new Cadastro;
	$conectar = $conectar->cadapr($id, $nome);
?>