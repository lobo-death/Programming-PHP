<?
	require_once("../model/conexao.php");
	require_once("../model/fpdf.php");
	
	$defe = $_REQUEST['defe'];
	
	// Verifica se houve REQUEST e se os campos são vazios
    if ((!empty($_REQUEST)) AND (empty($_REQUEST['defe']))) {
        $conexao = conexao();		
		$sql = "SELECT d.defesanum, c.curso, d.defesatitulo, d.defesaresumo, d.defesadata, c.periodo, d.defesahora, d.defesatipo FROM defesa AS d INNER JOIN cursos AS c ON (d.defesacurso = c.id) WHERE `situ_defe` = 1 ORDER BY d.defesanum";
		$res = mysql_query($sql, $conexao) or die ("erro");
    }else{
		$conexao = conexao();

		$sql = "SELECT * FROM `defesa` WHERE `defesanum` LIKE '%" .$defe ."%' AND `situ_defe` = 1 ORDER BY `defesanum` DESC";
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
		$this->Cell(150,$linha,'..:: Fatec Bauru - Relatorio de Defesas Cadastradas ::..',0,0,'C');
		$this->Cell(20,$linha,$hoje,0,0,'C');
		
		// quebra de linha
		$this->ln();
		$this->SetFillColor(232,232,232);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', 'B', 8);

		$this->Cell(10,4,'ID','LTR',0,'C',1);
		$this->Cell(30,4,'Curso','LTR',0,'C',1);
		$this->Cell(40,4,'Titulo','LTR',0,'C',1);
		$this->Cell(60,4,'Resumo','LTR',0,'C',1);
		$this->Cell(15,4,'Data','LTR',0,'C',1);
		$this->Cell(15,4,'Periodo','LTR',0,'C',1);
		$this->Cell(10,4,'Hora','LTR',0,'C',1);
		$this->Cell(10,4,'Tipo','LTR',0,'C',1);
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
	$id   = $linha["defesanum"];
	$curs = $linha["curso"];
	$titu = $linha["defesatitulo"];
	$resu = $linha["defesaresumo"];
	$data = $linha["defesadata"];
	$peri = $linha["periodo"];
	$hora = $linha["defesahora"];
	$tipo = $linha["defesatipo"];

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
	$pdf->SetX(25);
	$pdf->Rect(10,$y,40,$x);
	$pdf->Cell(20,6,trim($curs),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(65);
	$pdf->Rect(10,$y,80,$x);
	$pdf->Cell(10,6,trim($titu),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(115);
	$pdf->Rect(10,$y,140,$x);
	$pdf->Cell(10,6,trim($resu),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(150);
	$pdf->Rect(10,$y,155,$x);
	$pdf->Cell(70,6,date('d/m/y', strtotime($data)));
	
	$pdf->SetY($y);
	$pdf->SetX(145);
	$pdf->Rect(10,$y,170,$x);
	$pdf->Cell(55,6,trim($peri),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(155);
	$pdf->Rect(10,$y,180,$x);
	$pdf->Cell(60,6,trim($hora),0,0,'C');
	
	$pdf->SetY($y);
	$pdf->SetX(170);
	$pdf->Rect(10,$y,190,$x);
	$pdf->Cell(50,6,trim($tipo),0,0,'C');

	$pdf->ln();
	$y += $x;
	$conlin = $conlin + 1;
}
// imprime o PDF na tela
$pdf->OutPut();
?>