<?
	require_once("../model/conexao.php");
	require_once("../model/fpdf.php");
	
	$curs = $_REQUEST['curs'];
	
	// Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['curs']))) {
        $conexao = conexao();		

		$sql = "SELECT * FROM `cursos` ORDER BY `curso`";
		$res = mysql_query($sql, $conexao) or die ("erro");
    }else{
		$conexao = conexao();

		$sql = "SELECT * FROM `cursos` WHERE `curso` LIKE '%" .$curs ."%' ORDER BY `curso`";
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
		$this->Cell(10,$linha,$agora,0,0,'C');
		$this->Cell(150,$linha,'..:: Fatec Bauru - Relatorio de Cursos da Fatec ::..',0,0,'C');
		$this->Cell(30,$linha,$hoje,0,0,'C');
		
		// quebra de linha
		$this->ln();
		$this->SetFillColor(232,232,232);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', 'B', 8);

		$this->Cell(10,4,'ID','LTR',0,'C',1);
		$this->Cell(140,4,'Nome do Curso','LTR',0,'C',1);
		$this->Cell(40,4,'Periodo','LTR',0,'C',1);
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
	$curs = $linha["curso"];
	$peri = $linha["periodo"];

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
	$pdf->Rect(10,$y,150,$x);
	$pdf->Cell(150,6,trim($curs),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(170);
	$pdf->Rect(10,$y,190,$x);
	$pdf->Cell(20,6,trim($peri),0,0,'C');

	$pdf->ln();
	$y += $x;
	$conlin = $conlin + 1;
}
// imprime o PDF na tela
$pdf->OutPut();
?>