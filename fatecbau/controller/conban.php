<?
	require_once("../model/conexao.php");
	require_once("../model/fpdf.php");
	
	$banc = $_REQUEST['banc'];

	// Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['banc']))) {
        $conexao = conexao();		

		$sql = "SELECT b.id, b.bancanum, p.profnome AS prof, d.defesatitulo AS titu, t.tipo AS tipo, situ_banc FROM banca AS b INNER JOIN prof AS p ON (b.profnum = p.profnum) INNER JOIN defesa AS d ON (b.defesanum = d.defesanum) INNER JOIN tipos AS t ON (b.bancatipo = t.id) WHERE `situ_banc` = 1 ORDER BY bancanum DESC";
		$res = mysql_query($sql, $conexao) or die ("erro");
    }else{
		$conexao = conexao();
		$sql = "SELECT b.id, b.bancanum, p.profnome AS prof, d.defesatitulo AS titu, t.tipo AS tipo, situ_banc FROM banca AS b INNER JOIN prof AS p ON (b.profnum = p.profnum) WHERE `bancanum` LIKE " .$banc ." AND `situ_banc` = 1 ORDER BY bancanum DESC";
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
		$this->Cell(150,$linha,'..:: Fatec Bauru - Relatorio de Bancas Cadastradas ::..',0,0,'C');
		$this->Cell(20,$linha,$hoje,0,0,'C');
		
		// quebra de linha
		$this->ln();
		$this->SetFillColor(232,232,232);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', 'B', 8);

		$this->Cell(20,4,'ID','LTR',0,'C',1);
		$this->Cell(20,4,'Banca','LTR',0,'C',1);
		$this->Cell(50,4,'Professor','LTR',0,'C',1);
		$this->Cell(50,4,'Defesa','LTR',0,'C',1);
		$this->Cell(50,4,'Tipo da Banca','LTR',0,'C',1);
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
	$banc = $linha["bancanum"];
	$prof = $linha["prof"];
	$titu = $linha["titu"];
	$tpba = $linha["tipo"];

	if($conlin >= 50){
		$pdf->AddPage();
		$conlin = 1;
		$y      = 20;
	}
	$pdf->SetFont('Arial','',8);
	$pdf->SetY($y);
	$pdf->SetX(10);
	$pdf->Rect(10,$y,20,$x);
	$pdf->Cell(20,6,$id,0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(30);
	$pdf->Rect(10,$y,40,$x);
	$pdf->Cell(20,6,trim($banc),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(50);
	$pdf->Rect(10,$y,90,$x);
	$pdf->Cell(50,6,trim($prof),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(100);
	$pdf->Rect(10,$y,140,$x);
	$pdf->Cell(50,6,trim($titu),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(150);
	$pdf->Rect(30,$y,170,$x);
	$pdf->Cell(50,6,trim($tpba),0,0,'C');

	$pdf->ln();
	$y += $x;
	$conlin = $conlin + 1;
}
// imprime o PDF na tela
$pdf->OutPut();
?>