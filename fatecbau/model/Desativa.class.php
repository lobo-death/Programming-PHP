<?
	class Desativa{
		public function desalu($codigo, $nome, $situacao){
			// Tratamento das variaveis
			$id 	= $codigo;
			$alun 	= ucwords(strtolower($nome));
			$situ 	= $situacao;
			
			// Inserção no banco de dados
			$sql = mysql_query("SELECT `alunonum`,`alunonome`,`situ_alun` FROM `aluno` WHERE `alunonum` = '" .$id ."' AND `situ_alun` = 1 ;");
			$res = mysql_num_rows($sql);
			
			if($res == 1){				
				$update = mysql_query("UPDATE `aluno` SET `situ_alun` = '" . 0 . "' WHERE `alunonum` = '" .$id ."'");
			}else{
				$flash = "Desculpa mas esse aluno já foi desativado!";
			}
			if(isset($update)){
				$flash = "Desativacao realizada com sucesso!";
			}else{
				if($flash == ""){
					$flash = "Houve um erro na Desativacao!";
				}
			}
			// Retorno para o usuário
			echo '<script> alert("' .$flash .'");history.back();</script>';
		}
		
		public function desban($codigo, $bancanum, $profe, $defesa, $tipoba, $situac){
		    // Tratamento das variaveis
			$id 	= $codigo;
			$banu 	= ucwords(strtolower($bancanum));
			$prof	= $profe;
			$defe 	= $defesa;
			$tpba 	= $tipoba;
			$situ 	= $situac;
			
			// Inserção no banco de dados
			$sql = mysql_query("SELECT * FROM `banca` WHERE `id` = '" .$id ."' AND `situ_banc` = 1 ;");
			$res = mysql_num_rows($sql);
			
			if($res == 1){				
				$update = mysql_query("UPDATE `banca` SET `situ_banc` = '" . 0 . "' WHERE `id` = '" .$id ."'");
			}else{
				$flash = "Desculpa mas essa Banca já foi desativada!";
			}
			if(isset($update)){
				$flash = "Desativacao realizada com sucesso!";
			}else{
				if($flash == ""){
					$flash = "Houve um erro na Desativacao!";
				}
			}
			// Retorno para o usuário
			echo '<script> alert("' .$flash .'");history.back();</script>';
		}
		
		public function desdef($codigo, $defesa, $titulo, $resumo, $data, $hora, $tipo, $situac){
		    // Tratamento das variaveis
			$id 	= $codigo;
			$defe 	= ucwords(strtolower($defesa));
			$titu	= $titulo;
			$resu 	= $resumo;
			$data 	= $data;
			$hora 	= $hora;
			$tipo	= $tipo;
			$situ	= $situac;
			
			// Inserção no banco de dados
			$sql = mysql_query("SELECT * FROM `defesa` WHERE `defesanum` = '" .$id ."' AND `situ_defe` = 1 ;");
			$res = mysql_num_rows($sql);
			
			if($res == 1){				
				$update = mysql_query("UPDATE `defesa` SET `situ_defe` = '" . 0 . "' WHERE `id` = '" .$id ."'");
			}else{
				$flash = "Desculpa mas essa Defesa já foi desativada!";
			}
			if(isset($update)){
				$flash = "Desativacao realizada com sucesso!";
			}else{
				if($flash == ""){
					$flash = "Houve um erro na Desativacao!";
				}
			}
			// Retorno para o usuário
			echo '<script> alert("' .$flash .'");history.back();</script>';
		}
		
		public function desapr($codigo, $defesa, $aluno, $situac){
		    // Tratamento das variaveis
			$id 	= $codigo;
			$defe 	= ucwords(strtolower($defesa));
			$alun	= $aluno;
			$situ	= $situac;
			
			// Inserção no banco de dados
			$sql = mysql_query("SELECT * FROM `apres` WHERE `apresnum` = '" .$id ."' AND `situ_apre` = 1 ;");
			$res = mysql_num_rows($sql);
			
			if($res == 1){				
				$update = mysql_query("UPDATE `apres` SET `situ_apre` = '" . 0 . "' WHERE `apresnum` = '" .$id ."'");
			}else{
				$flash = "Desculpa mas essa Apresentacao ja foi desativada!";
			}
			if(isset($update)){
				$flash = "Desativacao realizada com sucesso!";
			}else{
				if($flash == ""){
					$flash = "Houve um erro na Desativacao!";
				}
			}
			// Retorno para o usuário
			echo '<script> alert("' .$flash .'");history.back();</script>';
		}
	}
?>