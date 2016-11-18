<?
	require_once("../model/conexao.php");
	require_once("../model/fpdf.php");
	
	$prof = $_REQUEST['prof'];
	$stat = $_REQUEST['stat'];
	
	// Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['prof'])) AND (empty($_REQUEST['stat']))) {
        $conexao = conexao();		
		if($stat == '1'){
			$sql = "SELECT * FROM `prof` WHERE `ativo` = 1 ORDER BY `cadastro` DESC";
			$res = mysql_query($sql, $conexao) or die ("erro");
		}else{
			$sql = "SELECT * FROM `prof` WHERE `ativo` = 0 ORDER BY `cadastro` DESC";
			$res = mysql_query($sql, $conexao) or die ("erro");
		}
    }else{
		$conexao = conexao();
		if($stat == '1'){
			$sql = "SELECT * FROM `prof` WHERE `profnick` LIKE '%" .$prof ."%' AND `ativo` = 1 ORDER BY `cadastro` DESC";
			$res = mysql_query($sql, $conexao) or die ("erro");			
		}else{
			$sql = "SELECT * FROM `prof` WHERE `profnick` LIKE '%" .$prof ."%' AND `ativo` = 0 ORDER BY `cadastro` DESC";
			$res = mysql_query($sql, $conexao) or die ("erro");
		}
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
		$this->Cell(150,$linha,'..:: Fatec Bauru - Relatorio de Professores Usuarios do Sistema ::..',0,0,'C');
		$this->Cell(20,$linha,$hoje,0,0,'C');
		
		// quebra de linha
		$this->ln();
		$this->SetFillColor(232,232,232);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', 'B', 8);

		$this->Cell(10,4,'ID','LTR',0,'C',1);
		$this->Cell(55,4,'Usuario','LTR',0,'C',1);
		$this->Cell(15,4,'Login','LTR',0,'C',1);
		$this->Cell(50,4,'E-mail','LTR',0,'C',1);
		$this->Cell(15,4,'Nivel','LTR',0,'C',1);
		$this->Cell(15,4,'Status','LTR',0,'C',1);
		$this->Cell(30,4,'Cadastro','LTR',0,'C',1);
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
	$id   = $linha["profnum"];
	$nome = $linha["profnome"];
	$nick = $linha["profnick"];
	$mail = $linha["email"];
	$nive = $linha["nivel"];
	$stat = $linha["ativo"];
	$data = $linha["cadastro"];

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
	$pdf->Rect(10,$y,65,$x);
	$pdf->Cell(55,6,trim($nome),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(75);
	$pdf->Rect(10,$y,80,$x);
	$pdf->Cell(15,6,trim($nick),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(90);
	$pdf->Rect(10,$y,130,$x);
	$pdf->Cell(50,6,trim($mail),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(140);
	$pdf->Rect(10,$y,145,$x);
	$pdf->Cell(15,6,trim($nive),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(155);
	$pdf->Rect(10,$y,160,$x);
	$pdf->Cell(15,6,trim($stat),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(170);
	$pdf->Rect(10,$y,190,$x);
	$pdf->Cell(30,6,trim($data),0,0,'C');

	$pdf->ln();
	$y += $x;
	$conlin = $conlin + 1;
}
// imprime o PDF na tela
$pdf->OutPut();
?>