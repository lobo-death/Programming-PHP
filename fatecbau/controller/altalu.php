<?	
    // Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['alun'])) AND (empty($_REQUEST['id']))) {
        header("Location: ../view/menu.php"); 
        exit;
    }
    
    $id		= $_REQUEST['id'];
	$alun	= $_REQUEST['alun'];
		
	require_once("../model/conexao.php");
	require_once("../model/Desativa.class.php");
	require_once("../model/DB.class.php");
	
	$conexao = conexao();
	
	$sql = ("SELECT `alunonum`,`alunonome`,`situ_alun` FROM `aluno` WHERE `alunonome` LIKE '%" .$alun ."%' AND `situ_alun` = 1 ;");
	$query 	= mysql_query($sql, $conexao);
	
	if ($row = mysql_fetch_array($query, MYSQL_BOTH)) {
		$id 	= $row['alunonum'];
		$alun 	= $row['alunonome'];
		$situ 	= $row['situ_alun'];
	}
	
	// Conexão com o banco de dados	
	$conectar = new DB;
	$conectar = $conectar->conectar();
	
	$conectar = new Altera;
	$conectar = $conectar->altalu($id, $alun, $situ);
?>