<?	
    // Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['defe'])) AND (empty($_REQUEST['id']))) {
        header("Location: ../view/menu.php"); 
        exit;
    }
    
    $id		= $_REQUEST['id'];
	$defe	= $_REQUEST['defe'];
		
	require_once("../model/conexao.php");
	require_once("../model/Desativa.class.php");
	require_once("../model/DB.class.php");
	
	$conexao = conexao();
	
	$sql = ("SELECT * FROM `defesa` WHERE `defesanum` LIKE '%" .$defe ."%' AND `situ_defe` = 1 ;");
	$query 	= mysql_query($sql, $conexao);
	
	if ($row = mysql_fetch_array($query, MYSQL_BOTH)) {
		$id 	= $row['defesanum'];
		$defe 	= $row['defesacurso'];
		$titu	= $row['defesatitulo'];
		$resu	= $row['defesaresumo'];
		$data	= $row['defesadata'];
		$hora	= $row['defesahora'];
		$tipo	= $row['defesatipo'];
		$situ 	= $row['situ_defe'];
	}
	
	// Conexão com o banco de dados	
	$conectar = new DB;
	$conectar = $conectar->conectar();
	
	$conectar = new Desativa;
	$conectar = $conectar->desdef($id, $defe, $titu, $resu, $data, $hora, $tipo, $situ);
?>