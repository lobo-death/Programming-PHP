<?	
    // Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['banc'])) AND (empty($_REQUEST['id']))) {
        header("Location: ../view/menu.php"); 
        exit;
    }
    
    $id		= $_REQUEST['id'];
	$banc	= $_REQUEST['banc'];
		
	require_once("../model/conexao.php");
	require_once("../model/Desativa.class.php");
	require_once("../model/DB.class.php");
	
	$conexao = conexao();
	
	$sql = ("SELECT * FROM `banca` WHERE `id` LIKE '%" .$id ."%' AND `situ_banc` = 1 ;");
	$query 	= mysql_query($sql, $conexao);
	
	if ($row = mysql_fetch_array($query, MYSQL_BOTH)) {
		$id 	= $row['id'];
		$banu 	= $row['bancanum'];
		$prof 	= $row['profnum'];
		$defe 	= $row['defesanum'];
		$tpba 	= $row['bancatipo'];
		$situ 	= $row['situ_banc'];
	}
	
	// Conexão com o banco de dados	
	$conectar = new DB;
	$conectar = $conectar->conectar();
	
	$conectar = new Desativa;
	$conectar = $conectar->desban($id, $banu, $prof, $defe, $tpba, $situ);
?>