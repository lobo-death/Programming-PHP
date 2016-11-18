<?
	require_once("../model/conexao.php");
	require_once("../model/fpdf.php");
	
	$logs = $_REQUEST['logs'];
	
	// Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['logs']))) {
        $conexao = conexao();		

		$sql = "SELECT * FROM `logs` ORDER BY `registro` DESC";
		$res = mysql_query($sql, $conexao) or die ("erro");
    }else{
		$conexao = conexao();

		$sql = "SELECT * FROM `logs` WHERE `login` LIKE '%" .$logs ."%' ORDER BY `registro` DESC";
		$res = mysql_query($sql, $conexao) or die ("erro");
	}

class PDF extends FPDF{
	function Header(){
		// define essa variavel para altura da linha
		$linha = 5;
		// define o X e Y na pagina
		$this->SetXY(10,10);
		// cria um retangulo que comeca na coordenada X,Y e
		// tem 190 de largura e 265 de altura, sendo neste caso,
		// a borda da pagina
		$this->Rect(10,10,190,265);
		
		// define a fonte a ser utilizada
		$this->SetFont('Arial', 'B', 8);
		$this->SetXY(11,11);
		
		// imprime uma celula com bordas opcionais, cor de fundo e texto.
		$agora = date("G:i:s");
		$hoje  = date("d/m/Y");
		$this->Cell(20,$linha,$agora,0,0,'C');
		$this->Cell(150,$linha,'..:: Fatec Bauru - Relatorio de Logs de Atividade ::..',0,0,'C');
		$this->Cell(20,$linha,$hoje,0,0,'C');
		
		// quebra de linha
		$this->ln();
		$this->SetFillColor(232,232,232);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', 'B', 8);

		$this->Cell(10,4,'ID','LTR',0,'C',1);
		$this->Cell(15,4,'Usuario','LTR',0,'C',1);
		$this->Cell(45,4,'Ticket da Sessao','LTR',0,'C',1);
		$this->Cell(30,4,'Data e Hora','LTR',0,'C',1);
		$this->Cell(20,4,'Micro','LTR',0,'C',1);
		$this->Cell(20,4,'IP Local','LTR',0,'C',1);
		$this->Cell(20,4,'Servidor','LTR',0,'C',1);
		$this->Cell(20,4,'IP Remoto','LTR',0,'C',1);
		$this->Cell(10,4,'Acao','LTR',0,'C',1);
	}

	function Footer(){
		$this->SetTextColor(0,0,0);
		$this->SetXY(11,272);
		$this->Rect(10,276,190,10);
		$this->Cell(190,7,'Pagina'.$this->PageNo().' de {nb}',0,0,'C');
	}
}

// cria um novo arquivo PDF no tamanho A4
$pdf = new PDF('P','mm','A4');
// adiciona uma pagina em branco
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',8);
$y = 20;
$x = 5;

$conlin = 1;
while($linha=mysql_fetch_array($res)){
	$id   = $linha["id"];
	$logi = $linha["login"];
	$tick = $linha["ticket"];
	$regi = $linha["registro"];
	$host = $linha["host"];
	$ipv4 = $linha["ipv4"];
	$serv = $linha["server"];
	$ipse = $linha["ipserv"];
	$acao = $linha["acao"];

	if($conlin >= 50){
		$pdf->AddPage();
		$conlin = 1;
		$y      = 20;
	}
	$pdf->SetFont('Arial','',8);
	$pdf->SetY($y);
	$pdf->SetX(10);
	$pdf->Rect(10,$y,10,$x);
	$pdf->Cell(10,6,$id,0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(20);
	$pdf->Rect(10,$y,25,$x);
	$pdf->Cell(15,6,trim($logi),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(35);
	$pdf->Rect(10,$y,70,$x);
	$pdf->Cell(45,6,trim($tick),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(80);
	$pdf->Rect(10,$y,100,$x);
	$pdf->Cell(30,6,trim($regi),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(110);
	$pdf->Rect(10,$y,120,$x);
	$pdf->Cell(20,6,trim($host),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(130);
	$pdf->Rect(10,$y,140,$x);
	$pdf->Cell(20,6,trim($ipv4),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(150);
	$pdf->Rect(10,$y,160,$x);
	$pdf->Cell(20,6,trim($serv),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(170);
	$pdf->Rect(10,$y,180,$x);
	$pdf->Cell(20,6,trim($ipse),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(190);
	$pdf->Rect(10,$y,190,$x);
	$pdf->Cell(10,6,trim($acao),0,0,'C');

	$pdf->ln();
	$y += $x;
	$conlin = $conlin + 1;
}
// imprime o PDF na tela
$pdf->OutPut();
?>