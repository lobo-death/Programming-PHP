		<?php  
			/* esse bloco de código em php verifica se existe a sessão, pois o usuário pode 
			simplesmente não fazer o login e digitar na barra de endereço do seu navegador o 
			caminho para a página principal do site (sistema), burlando assim a obrigação de 
			fazer um login, com isso se ele não estiver feito o login não será criado a session, 
			então ao verificar que a session não existe a página redireciona o mesmo para a index.php. */
			session_start();
			if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['pass']) == true)){
				unset($_SESSION['user']);
				unset($_SESSION['pass']);
				header('location:../view/index.html');
			}else{
				$logado = $_SESSION['user'];
				$sessao = session_id();
				if($logado != "admin"){
					$nivel=true;
				}
			}			
		?>
<?
	require_once("../model/conexao.php");

	/*function php_excluir($id){
			$conexao  = conexao();
			$sql      = "delete from prof where profnum=$id";
			mysql_query($sql,$conexao);
			$x = "professor excluido !";
			return $x;
	}*/

	function php_gravar($nome){
			$conexao  = conexao();
			$sql      = "INSERT INTO aluno (alunonum, alunonome, situ_alun) values (null,'$nome',1)";
			mysql_query($sql,$conexao);
			$x = "Alteracao realizada!";
			return $x;
	}

	function php_alterar($id,$nome){
			$conexao  = conexao();
			$sql      = "UPDATE aluno SET alunonome='$nome' where alunonum=$id";
			mysql_query($sql,$conexao);
			$x = "Alteracao realizada!";
			return $x;
	}

	require_once("Sajax.php");
	sajax_init();
	sajax_export("php_excluir","php_gravar","php_alterar");
	sajax_handle_client_request();
?>

<!DOCTYPE html>
<html>
	<script>
		<?
			sajax_show_javascript();
		?>
		
		function mostra( x ){
			alert( x );
			document.frm.submit();
		}
		
		/*function excluir(id){
			var decisao = confirm("Excluir professor ?");
			if (decisao){
				x_php_excluir( id , mostra );
			}				
		}*/	

		function gravar(){
			var gru_nome2 = document.getElementById("pesq").value;
			var gru_id2   = document.getElementById("gru_id").value;
			
			if (gru_id2==""){ 
				x_php_gravar( gru_nome2 , mostra );
			}else{
				x_php_alterar( gru_id2 , gru_nome2 , mostra );
			}
			document.getElementById("pesq").value = "";
		}

		function alterar( id , nome ){
			document.getElementById("pesq").value = nome;
			document.getElementById("gru_id").value = id;
		}
	</script>

	<?
		$conexao  = conexao();

		if (isset($_REQUEST["pesq"])){
			$pesquisa = $_REQUEST["pesq"];
		}else{
			$pesquisa = "";
		}

		if ($pesquisa==""){
			$sql = "SELECT * FROM aluno ORDER BY alunonome";
		}else{
			$sql = "SELECT * FROM aluno WHERE alunonome like '$pesquisa%' ORDER BY alunonome";
		}			  
		$resultado = mysql_query( $sql , $conexao ) or die("Erro SQL" . $sql );
	?>
	
	<head>
		<meta charset="UTF-8">
		<title>Fatec Bauru - Banca</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/menu.css">
	</head>
	
	<body>
		<div class="tabs-container">
			<!-- Home -->
			<input type="radio" name="tabs" class="tabs" id="tab1" checked>
			<label for="tab1">  Home   </label>
			<div>
				<center><h2>Sistema para Agendamento de Trabalhos de Graduação</h2></center><br>
				<center><h4>Uso exclusivo para fins Didáticos</h4></center><br>
				<center><img src="images/logo_cps.png" width="200" height="130" alt="Centro Paula Souza"></center><br>
				<center><h2>Utilize o menu acima para realizar a operação que desejar no sistema.</h2></center>
			</div>
			
			<!-- Cadastrar -->
			<input type="radio" name="tabs" class="tabs" id="tab2">
			<label for="tab2">Cadastrar</label>
			<div>
				<div class="tab-container">
					<input type="radio" name="tab" class="tab" id="tab21" checked>
					<label for="tab21">Aluno</label>
					<div class="form bradius"><label>Cadastrar Aluno</label><br>
						<form method="POST" action="../controller/cadalu.php" name="cadalu" id="cadalu" onSubmit="return validaalun();">
														   <input type="hidden" id="id" name="id" />
							<label for="alun">Nome:</label><input type="text" id="alun" name="alun" class="txt bradius" tabindex="1" autocomplete="off" size="50" placeholder=" Digite o Nome do Aluno " size="50" autofocus /><br><br>
							<input type="submit" class="sb bradius" value="Cadastrar" tabindex="2" />
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab22">
					<label for="tab22">Banca</label>
					<div class="form bradius"><label>Cadastrar Banca</label><br>
					    <form method="POST" action="../controller/cadban.php" name="cadban" id="cadban" onSubmit="return validabanc();">
																	  <input type="hidden" id="id" name="id" />
					        <label for="banc">Banca:          </label><input type="text" id="banc" name="banc" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite o Número da Banca " 	 size="50" autofocus />
					        <label for="prof">Professor:      </label><input type="text" id="prof" name="prof" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite o Número do Professor "  size="50" />
					        <label for="defe">Defesa:         </label><input type="text" id="defe" name="defe" class="txt bradius" tabindex="3" autocomplete="off" placeholder=" Digite o Número da Defesa " 	 size="50" />
					        <label for="tpba">Tipo da Banca:  </label><input type="text" id="tpba" name="tpba" class="txt bradius" tabindex="4" autocomplete="off" placeholder=" Informe o Tipo da Banca " 		 size="50" /><br><br>
					        <input type="submit" class="sb bradius" value="Cadastrar" tabindex="5">
					    </form>	
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab23">
					<label for="tab23">Defesa</label>
					<div class="bradius"><label>Cadastrar Defesa</label><br><br><br>
						<form method="POST" action="../controller/caddef.php" id="caddef" name="caddef" onSubmit="return validadef();">
																 <input type="hidden" id="id" name="id" />
							<label for="data">Data:		 </label><input type="text" id="data" name="data" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" DD / MM / YYYY " 					size="50" autofocus />
							<label for="orie">Orientador:</label><input type="text" id="orie" name="orie" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite para Alterar o Orientador " 	size="50" /><br><br>
							<label for="curs">Curso:</label>
								<select id="curs" name="curs" class="txt bradius" tabindex="3">
									<option value="0" selected> Selecione uma Opção </option>
									<option value="1">Automação Industrial</option>
									<option value="2">Banco de Dados</option>
									<option value="3">Gestão Empresarial</option>
									<option value="4">Redes de Computadores</option>
									<option value="5">Sistemas Biomédicos</option>
								</select>
							<label for="tpba">Tipo de Banca:</label>
								<select id="tpba" name="tpba" class="txt bradius" tabindex="4">
									<option value="0" selected> Selecione uma Opção </option>
									<option value="1">Trabalho de Graduação I</option>
									<option value="2">Trabalho de Graduação II</option>
								</select>
							<label for="hora">Horário:</label>
								<select id="hora" name="hora" class="txt bradius" tabindex="5">
									<option value="0" selected> Selecione uma Opção </option>
									<option value="1">08hs00</option>
									<option value="2">09hs00</option>
									<option value="3">10hs00</option>
									<option value="4">19hs00</option>
									<option value="5">20hs00</option>
									<option value="6">21hs00</option>
								</select><br><br>
							<label for="titu">Titulo: </label><input type="text" id="titu" name="titu" class="txt bradius" tabindex="6" autocomplete="off" placeholder=" Digite para Alterar o Titulo " size="50" />
							<label for="resu">Resumo: </label><input type="text" id="resu" name="resu" class="txt bradius" tabindex="7" autocomplete="off" placeholder=" Digite para Alterar o Resumo " size="50" />
							<label for="alun">Aluno:  </label><input type="text" id="alun" name="alun" class="txt bradius" tabindex="8" autocomplete="off" placeholder=" Digite para Alterar o Aluno "  size="50" /><br><br>
							<input type="submit" class="sb bradius" value="Cadastrar" tabindex="9" />
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab24">
					<label for="tab24">Apresentação</label>
					<div class="form bradius"><label>Cadastrar Apresentação</label><br>
					    <form method="POST" action="../controller/cadapr.php" id="cadapr" name="cadapr" onSubmit="return validaapre();">
															  <input type="hidden" name="id" id="id" />
							<label for="defe">Defesa: </label><input type="text" id="defe" name="defe" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite o Titulo da Defesa " size="50" autofocus />
					        <label for="alun">Aluno:  </label><input type="text" id="alun" name="alun" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite o Nome do Aluno " 	 size="50" /><br><br>
					        <input type="submit" class="sb bradius" value="Cadastrar" tabindex="3">
					    </form>
					</div>
					
					<!-- Area Restrita -- Inicio -->
					
					<? 
					require_once("../model/conexao.php");
					
					$conexao = conexao();
					
					$sql 	= ("SELECT * FROM `prof` WHERE `profnick` LIKE 'admin' AND `profnick` LIKE '" .$logado ."' AND `nivel` = 3 AND `ativo` = 1 LIMIT 1");
					$query 	= mysql_query($sql, $conexao);
					
					if ($row = mysql_num_rows($query)) { 
						?>
							<input type="radio" name="tab" class="tab" id="tab25" />
							<label for="tab25">Cursos</label>
							<div class="form bradius"><label>Cadastrar Cursos</label><br>
								<form method="POST" action="../controller/cadcur.php" id="cadcur" name="cadcur" target="_blank" onSubmit="return validacurs();">
																	   <input type="hidden" id="id" name="id" />
									<label for="curs">Cursos:  </label><input type="text" id="curs" name="curs" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite o Nome do Curso "  size="50" autofocus />
									<label for="peri">Período: </label><input type="text" id="peri" name="peri" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite o Período " 		size="50" /><br><br>
									<input class="sb bradius" type="submit" value="Cadastrar" tabindex="3" />
								</form>
							</div>
						<?						
					}else{
						?>
							<input type="radio" name="tab" class="tab" id="tab25" />
							<label for="tab25" class="visual">Cursos</label>
							<div class="form bradius visual"><label>Cadastrar Cursos</label><br>
								<form method="POST" action="../controller/cadcur.php" id="cadcur" name="cadcur" target="_blank" onSubmit="return validacurs();">
																		   <input type="hidden" id="id" name="id" />
									<label for="curs">Cursos: </label><input type="text" id="curs" name="curs" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite o Nome do Curso " autofocus />
									<label for="peri">Cursos: </label><input type="text" id="peri" name="peri" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite o Período " />
									<input class="sb bradius" type="submit" value="Cadastrar" tabindex="3" />
								</form>
							</div>
						<?
					}
					?>
					
					<!-- Area Restrita -- Fim -->
					
				</div>				
			</div>
			
			<!-- Consultar -->
			<input type="radio" name="tabs" class="tabs" id="tab3">
			<label for="tab3">Consultar</label>
			<div>
				<div class="tab-container">
					<input type="radio" name="tab" class="tab" id="tab31">
					<label for="tab31">Aluno</label>
					<div class="form bradius"><label>Consultar Aluno</label><br>
						<form method="POST" action="../controller/conalu.php" id="conalu" name="conalu" target="_blank" onSubmit="return validaalun();">
															 <input type="hidden" id="id" name="id" />
							<label for="alun">Aluno: </label><input type="text" id="alun" name="alun" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
							<input class="sb bradius" type="submit" value="Consultar" tabindex="2" />
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab32">
					<label for="tab32">Banca</label>
					<div class="form bradius"><label>Consultar Banca</label><br>
					    <form method="POST" action="../controller/conban.php" id="conban" name="conban" target="_blank" onSubmit="return validabanc();">
													 		 <input type="hidden" id="id" name="id" />
							<label for="banc">Banca: </label><input type="text" id="banc" name="banc" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
							<input class="sb bradius" type="submit" value="Consultar" tabindex="2" />
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab33">
					<label for="tab33">Defesa</label>
					<div class="form bradius"><label>Consultar Defesa</label><br>
					    <form method="POST" action="../controller/condef.php" id="condef" name="condef" target="_blank" onSubmit="return validadef();">
															    <input type="hidden" id="id" name="id" />
							<label for="condef">Defesa: </label><input type="text" id="defe" name="defe" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
							<input class="sb bradius" type="submit" value="Consultar" tabindex="2" />
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab34">
					<label for="tab34">Apresentação</label>
					<div class="form bradius"><label>Consultar Apresentação</label><br>
					    <form method="POST" action="../controller/conapr.php" id="conapr" name="conapr" target="_blank" onSubmit="return validaapre();">
																	<input type="hidden" id="id" name="id" />
							<label for="apre">Apresentação: </label><input type="text" id="apre" name="apre" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " autofocus />
							<input class="sb bradius" type="submit" value="Consultar" tabindex="2" />
						</form>
					</div>
					
					<!-- Area Restrita -- Inicio -->
					
					<? 
					require_once("../model/conexao.php");
					
					$conexao = conexao();
					
					$sql 	= ("SELECT * FROM `prof` WHERE `profnick` LIKE 'admin' AND `profnick` LIKE '" .$logado ."' AND `nivel` = 3 AND `ativo` = 1 LIMIT 1");
					$query 	= mysql_query($sql, $conexao);
					
					if ($row = mysql_num_rows($query)) { 
						?>
							<input type="radio" name="tab" class="tab" id="tab35" />
							<label for="tab35">Professores</label>
							<div class="form bradius"><label>Consultar Professores</label><br>
								<form method="POST" action="../controller/conpro.php" id="conpro" name="conpro" target="_blank" onSubmit="return validaapre();">
																		   <input type="hidden" id="id" name="id" />
									<label for="prof">Professores: </label><input type="text" id="prof" name="prof" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
									<fieldset class="bradius" width="250"><legend>Usuário Ativo?</legend>
										<input type="radio" id="nao" name="stat" class="bradius" value="0" checked/><label for="nao">Não</label><br>
										<input type="radio" id="sim" name="stat" class="bradius" value="1" /><label for="sim">Sim</label><br><br>
									</fieldset>
									<input class="sb bradius" type="submit" value="Consultar" tabindex="2" target="_blank" />
								</form>
							</div>
							
							<input type="radio" name="tab" class="tab" id="tab36" />
							<label for="tab36">Cursos</label>
							<div class="form bradius"><label>Consultar Cursos</label><br>
								<form method="POST" action="../controller/concur.php" id="concur" name="concur" target="_blank" onSubmit="return validacurs();">
																		   <input type="hidden" id="id" name="id" />
									<label for="curs">Cursos: </label><input type="text" id="curs" name="curs" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
									<input class="sb bradius" type="submit" value="Consultar" tabindex="2" target="_blank" />
								</form>
							</div>
							
							<input type="radio" name="tab" class="tab" id="tab37">
							<label for="tab37">Logs</label>
							<div class="form bradius"><label>Consultar Logs de Atividade</label><br>
								<form method="POST" action="../controller/conlog.php" id="conlog" name="conlog" target="_blank" onSubmit="return validaapre();">
																			<input type="hidden" id="id" name="id" />
									<label for="logs">Logs de Atividade: </label><input type="text" id="logs" name="logs" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
									<input class="sb bradius" type="submit" value="Consultar" tabindex="2" target="_blank" />
								</form>
							</div>
						<?						
					}else{
						?>
							<input type="radio" name="tab" class="tab" id="tab35" />
							<label for="tab35" class="visual">Professores</label>
							<div class="form bradius visual"><label>Consultar Professores</label><br>
								<form method="POST" action="../controller/conapr.php" id="conpro" name="conpro" target="_blank" onSubmit="return validaapre();">
																		   <input type="hidden" id="id" name="id" />
									<label for="apre">Professores: </label><input type="text" id="apre" name="apre" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
									<input class="sb bradius" type="submit" value="Consultar" tabindex="2" target="_blank" />
								</form>
							</div>
							
							<input type="radio" name="tab" class="tab" id="tab36" />
							<label for="tab36" class="visual">Cursos</label>
							<div class="form bradius visual"><label>Consultar Cursos</label><br>
								<form method="POST" action="../controller/concur.php" id="concur" name="concur" target="_blank" onSubmit="return validacurs();">
																		   <input type="hidden" id="id" name="id" />
									<label for="curs">Cursos: </label><input type="text" id="curs" name="curs" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
									<input class="sb bradius" type="submit" value="Consultar" tabindex="2" target="_blank" />
								</form>
							</div>
							
							<input type="radio" name="tab" class="tab" id="tab37">
							<label for="tab37" class="visual">Logs</label>
							<div class="form bradius visual"><label>Consultar Logs de Atividade</label><br>
								<form method="POST" action="../controller/conlog.php" id="conlog" name="conlog" target="_blank" onSubmit="return validaapre();">
																			<input type="hidden" id="id" name="id" />
									<label for="apre">Logs de Atividade: </label><input type="text" id="apre" name="apre" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Consultar " size="50" autofocus /><br><br>
									<input class="sb bradius" type="submit" value="Consultar" tabindex="2" target="_blank" />
								</form>
							</div>
						<?
					}
					?>
					
					<!-- Area Restrita -- Fim -->
				</div>
			</div>
			
			<!-- Alterar -->
			<input type="radio" name="tabs" class="tabs" id="tab4">
			<label for="tab4"> Alterar </label>
			<div>
				<div class="tab-container">
					<input type="radio" name="tab" class="tab" id="tab41">
					<label for="tab41">Aluno</label>
					<div class="bradius"><label>Alterar Aluno</label><br>
						<form method="POST" action="#" id="altalu"  name="altalu" onSubmit="return validaalun();">
															<input type="hidden" id="id" name="id" />
							<label for="alun">Nome: </label><input type="text" id="pesq" name="pesq" class="txt bradius" tabindex="1" value="<?=$pesquisa;?>" size="25"><br><br>
							<label for="id"> ID </label><label for="alun"> Nome do Aluno </label><label for="excl"> Excluir </label><br>
							<?
								while ($linha=mysql_fetch_array($resultado)){
									$id   = $linha["alunonum"];
									$nome = $linha["alunonome"];		
							?>
							<input type="text" value="<? echo $linha["alunonum"]; ?>" /><a href="javascript: alterar( <?=$id;?> , '<?=$nome;?>' )"> <? echo $linha["alunonome"]; ?> </a><input type="button" value="X" onclick="excluir(<?=$id;?>);">
							<?
								}
							?>
							<!-- <input type="text" id="alun" name="alun" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite para Alterar o Nome do Aluno " size="50" autofocus value="<?  ?>"/><br><br> -->
							<input class="sb bradius" type="submit" value="Pesquisar" tabindex="3" onclick="javascript: document.altalu.submit();" />
							<input class="sb bradius" type="submit" value="Alterar"   tabindex="4" onclick="javascript: gravar(); " />
						</form>						
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab42">
					<label for="tab42">Banca</label>
					<div class="form bradius"><label>Alterar Banca</label><br>
					    <form method="POST" action="../controller/altban.php" id="altban" name="altban" onSubmit="return validabanc();">
																	<input type="hidden" id="id" name="id" />
					        <label for="banc">Banca:        </label><input type="text" id="banc" name="banc" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite para Alterar a Banca " 	 size="50" autofocus />
					        <label for="prof">Professor:    </label><input type="text" id="prof" name="prof" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite para Alterar o Professor " size="50" />
					        <label for="defe">Defesa:       </label><input type="text" id="defe" name="defe" class="txt bradius" tabindex="3" autocomplete="off" placeholder=" Digite para Alterar a Defesa " 	 size="50" />
					        <label for="tpba">Tipo da Banca:</label><input type="text" id="tpba" name="tpba" class="txt bradius" tabindex="4" autocomplete="off" placeholder=" Digite para Alterar o Tipo " 	 size="50" /><br><br>
					        <input class="sb bradius" type="submit" value="Alterar" tabindex="5" />
					    </form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab43">
					<label for="tab43">Defesa</label>
					<div class="bradius"><label>Alterar Defesa</label><br><br><br>
						<form method="POST" action="../controller/altdef.php" name="aldf" id="aldf" onSubmit="return validadef();">
																 <input type="hidden" id="id" name="id" />
							<label for="data">Data:		 </label><input type="text" id="data" name="data" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Clique para Alterar a Data " 		size="50" autofocus />
							<label for="orie">Orientador:</label><input type="text" id="orie" name="orie" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite para Alterar o Orientador " 	size="50" /><br><br>
							<label for="curs">Curso:</label>
								<select id="curs" name="curs" class="txt bradius" tabindex="3">
									<option value="0" selected> Selecione uma Opção </option>
									<option value="1">Automação Industrial</option>
									<option value="2">Banco de Dados</option>
									<option value="3">Gestão Empresarial</option>
									<option value="4">Redes de Computadores</option>
									<option value="5">Sistemas Biomédicos</option>
								</select>
							<label for="tpba">Tipo de Banca:</label>
								<select id="tpba" name="tpba" class="txt bradius" tabindex="4">
									<option value="0" selected> Selecione uma Opção </option>
									<option value="1">Trabalho de Graduação I</option>
									<option value="2">Trabalho de Graduação II</option>
								</select>
							<label for="hora">Horário:</label>
								<select id="hora" name="hora" class="txt bradius" tabindex="5">
									<option value="0" selected> Selecione uma Opção </option>
									<option value="1">08hs00</option>
									<option value="2">09hs00</option>
									<option value="3">10hs00</option>
									<option value="4">19hs00</option>
									<option value="5">20hs00</option>
									<option value="6">21hs00</option>
								</select><br><br>
							<label for="titu">Titulo: </label><input type="text" id="titu" name="titu" class="txt bradius" tabindex="6" autocomplete="off" placeholder=" Digite para Alterar o Titulo " size="50" />
							<label for="resu">Resumo: </label><input type="text" id="resu" name="resu" class="txt bradius" tabindex="7" autocomplete="off" placeholder=" Digite para Alterar o Resumo " size="50" />
							<label for="alun">Aluno:  </label><input type="text" id="alun" name="alun" class="txt bradius" tabindex="8" autocomplete="off" placeholder=" Digite para Alterar o Aluno "  size="50" /><br><br>
							<input class="sb bradius" type="submit" value="Alterar" tabindex="9">
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab44">
					<label for="tab44">Apresentação</label>
					<div class="form bradius"><label>Alterar Apresentação</label><br>
					    <form method="POST" action="../controller/altapr.php" id="altapr" name="altapr" onSubmit="return validaapre();">
													 		 <input type="hidden" id="id" name="id" />
					        <label for="defe">Defesa:</label><input type="text" id="defe" name="defe" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite para Alterar a Defesa " size="50" autofocus />
					        <label for="alun">Aluno: </label><input type="text" id="alun" name="alun" class="txt bradius" tabindex="2" autocomplete="off" placeholder=" Digite para Alterar o Aluno "  size="50" /><br><br>
					        <input class="sb bradius" type="submit" value="Alterar" tabindex="3" />
					    </form>
					</div>
				</div>
			</div>
			
			<!-- Desativar -->
			<input type="radio" name="tabs" class="tabs" id="tab5">
			<label for="tab5">Desativar</label>
			<div>
				<div class="tab-container">
					<input type="radio" name="tab" class="tab" id="tab51">
					<label for="tab51">Aluno</label>
					<div class="form bradius"><label>Desativar Aluno</label><br>
						<form method="POST" action="../controller/desalu.php" name="desalu" id="desalu" onSubmit="return validaalun();">
															 <input type="hidden" id="id" name="id" />
							<label for="alun">Aluno: </label><input type="text" id="alun" name="alun" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Desativar " size="50" autofocus /><br><br>
							<input class="sb bradius" type="submit" value="Desativar" tabindex="2">
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab52">
					<label for="tab52">Banca</label>
					<div class="form bradius"><label>Desativar Banca</label><br>
					    <form method="POST" action="../controller/desban.php" id="desban" name="desban" onSubmit="return validabanc();">
															 <input type="hidden" id="id" name="id" />			
							<label for="banc">Banca: </label><input type="text" id="banc" name="banc" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Desativar " size="50" autofocus /><br><br>
							<input class="sb bradius" type="submit" value="Desativar" tabindex="2">
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab53">
					<label for="tab53">Defesa</label>
					<div class="form bradius"><label>Desativar Defesa</label><br>
					    <form method="POST" action="../controller/desdef.php" id="desdef" name="desdef" onSubmit="return validadefe();">
															  <input type="hidden" id="id" name="id" />
							<label for="defe">Defesa: </label><input type="text" id="defe" name="defe" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Desativar " size="50" autofocus><br><br>
							<input  class="sb bradius" type="submit" value="Desativar" tabindex="2">
						</form>
					</div>
					
					<input type="radio" name="tab" class="tab" id="tab54">
					<label for="tab54">Apresentação</label>
					<div class="form bradius"><label>Desativar Apresentação</label><br>
					    <form method="POST" action="../controller/desapr.php" id="desapr" name="desapr" onSubmit="return validaapre();">
																	<input type="hidden" id="id" name="id" />
							<label for="apre">Apresentação: </label><input type="text" id="apre" name="apre" class="txt bradius" tabindex="1" autocomplete="off" placeholder=" Digite ou Clique em Desativar " size="50" autofocus><br><br>
							<input class="sb bradius" type="submit" value="Desativar" tabindex="2">
						</form>
					</div>
				</div>
			</div>
			
			<!-- Ajuda -->
			<input type="radio" name="tabs" class="tabs" id="tab6">
			<label for="tab6">  Ajuda  </label>
			<div>
				Ajuda
			</div>
			
			<!-- Sobre -->
			<input type="radio" name="tabs" class="tabs" id="tab7">
			<label for="tab7">  Sobre  </label>
			<div>
				<article>
				<center><h2>Sistema para Agendamento de Trabalhos de Graduação</h2></center><br>
				<center><h4>Uso exclusivo para fins Didáticos</h4></center><br>
				<center><img src="images/logo_cps.png" width="200" height="130" alt="Centro Paula Souza"></center><br>
				<center>Desenvolvido na Disciplina de Tópicos Avançados de Engenharia de Software</center><br>
				<center>Linguagem de Programação: PHP OOP + JavaScript + HTML5 + CSS3</center>
				<center>Banco de Dados: Oracle MySQL Server</center>
				<center>Autores: Fabiana Martins da Silva & Marcelo Machado Pereira</center>
				<center>Alunos da Graduação em Ciência da Computação do 3° Ano 2016.</center><br>
				<center>FIB Bauru - Todos os Direitos Reservados</center>
				</article>
			</div>
		</div>
		<script language="JavaScript" src="../controller/js/validaalun.js"></script>
		<script language="JavaScript" src="../controller/js/validabanc.js"></script>
		<script language="JavaScript" src="../controller/js/validadefe.js"></script>
		<script language="JavaScript" src="../controller/js/validaapre.js"></script>
		<footer>
			<label> 
				<? 
					require_once("../model/conexao.php");
					
					$conexao = conexao();
					
					$sql 	= ("SELECT `profnum`, `profnome`, `profnick`, `senha` FROM `prof` WHERE (`profnick` = '".$logado ."') LIMIT 1");
					$query 	= mysql_query($sql, $conexao);
					
					if ($row = mysql_fetch_array($query, MYSQL_BOTH)) { ?>
						<article><? echo "Login : "  , $row['profnome'];   ?></article>
						<article><? echo "Ticket : " , $sessao;  	       ?></article>
						<?
						$login = $row['profnick'];
						$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
						$ipv4 = ($_SERVER['REMOTE_ADDR']);
						$serv = gethostbyaddr($_SERVER['SERVER_ADDR']);
						$ipse = ($_SERVER['SERVER_NAME']);
						
						$sql 	= ("INSERT INTO `logs` (`id`, `login`, `ticket`, `registro`, `host`, `ipv4`, `server`, `ipserv`, `acao`, `status`) VALUES (NULL,'$login','$sessao', now(),'$host','$ipv4','$serv','$ipse', 'L', 1);");
						$query 	= mysql_query($sql, $conexao); 
					}
				?>
			</label>
			<button type="button" class="sb bradius" onclick="javascript:history.back()">Sair</button>
		</footer>
	</body>
</html>