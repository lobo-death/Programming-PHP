<?	
    // Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['banc']))) {
        header("Location: ../view/menu.php"); 
        exit;
    }
    
	$id   = $_REQUEST['id'];
	$banc = $_REQUEST['banc'];
	$prof = $_REQUEST['prof'];
	$defe = $_REQUEST['defe'];
	$tpba = $_REQUEST['tpba'];
    		
	require_once("../model/Cadastro.class.php");
	require_once("../model/DB.class.php");
	
	// Conexão com o banco de dados	
	$conectar = new DB;
	$conectar = $conectar->conectar();
	
	$conectar = new Cadastro;
	$conectar = $conectar->cadban($id, $banc, $prof, $defe, $tpba);
?>