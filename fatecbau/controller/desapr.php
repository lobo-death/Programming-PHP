<?	
    // Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['apre'])) AND (empty($_REQUEST['id']))) {
        header("Location: ../view/menu.php"); 
        exit;
    }
    
    $id		= $_REQUEST['id'];
	$apre	= $_REQUEST['apre'];
		
	require_once("../model/conexao.php");
	require_once("../model/Desativa.class.php");
	require_once("../model/DB.class.php");
	
	$conexao = conexao();
	
	$sql = ("SELECT * FROM `apres` WHERE `apresnum` LIKE '%" .$id ."%' AND `situ_apre` = 1 ;");
	$query 	= mysql_query($sql, $conexao);
	
	if ($row = mysql_fetch_array($query, MYSQL_BOTH)) {
		$id 	= $row['apresnum'];
		$defe 	= $row['defesanum'];
		$alun	= $row['alunonum'];
		$situ 	= $row['situ_apre'];
	}
	
	// Conexão com o banco de dados	
	$conectar = new DB;
	$conectar = $conectar->conectar();
	
	$conectar = new Desativa;
	$conectar = $conectar->desapr($id, $defe, $alun, $situ);
?>