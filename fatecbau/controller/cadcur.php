<?	
    // Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['curs'])) AND (empty($_REQUEST['peri']))) {
        header("Location: ../view/menu.php"); 
        exit;
    }
    
    $id		= mysql_real_escape_string($_REQUEST['id']);
	$curs	= mysql_real_escape_string($_REQUEST['curs']);
	$peri	= mysql_real_escape_string($_REQUEST['peri']);
		
	// require_once("../model/conexao.php");
	require_once("../model/Cadastro.class.php");
	require_once("../model/DB.class.php");
	
	// Conexão com o banco de dados	
	$conectar = new DB;
	$conectar = $conectar->conectar();
	
	$conectar = new Cadastro;
	$conectar = $conectar->cadcur($id, $curs, $peri);
?>