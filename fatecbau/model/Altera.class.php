<?
	class Altera{
		public function altalu($codigo, $aluno, $situac){
			// Tratamento das variaveis
			$id 	= $codigo;
			$alun 	= ucwords(strtolower($aluno));
			$situ 	= $situac;
			
			// Inserção no banco de dados
			$sql = mysql_query("SELECT `alunonum`,`alunonome`,`situ_alun` FROM `aluno` WHERE `alunonum` = '" .$id ."' AND `situ_alun` = 1 ;");
			$res = mysql_num_rows($sql);
			
			if ($row = mysql_fetch_array($query, MYSQL_BOTH)) { 
				?>
					<article><? echo "Login : "  , $row['alunonome'];   ?></article>
					<article><? echo "Ticket : " , $row[''];  	       ?></article>
				<?
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
		
		public function altban(){
		    // Tratamento das variaveis
			$id 	= $codigo;
			$alun 	= ucwords(strtolower($nome));
			$situ 	= $situacao;
			
			// Inserção no banco de dados
			$sql = mysql_query("SELECT `alunonum`,`alunonome`,`situ_alun` FROM `banca` WHERE `bancanum` = '" .$id ."' AND `situ_banc` = 1 ;");
			$res = mysql_num_rows($sql);
			
			if($res == 1){				
				$update = mysql_query("UPDATE `aluno` SET `situ_alun` = '" . 0 . "' WHERE `alunonum` = '" .$id ."'");
			}else{
				$flash = "Desculpa mas essa Banca já foi atualizada!";
			}
			if(isset($update)){
				$flash = "Atualizacao realizada com sucesso!";
			}else{
				if($flash == ""){
					$flash = "Houve um erro na Atualizacao!";
				}
			}
			// Retorno para o usuário
			echo '<script> alert("' .$flash .'");history.back();</script>';
		}
		
		public function altdef(){
		    // Tratamento das variaveis
			$id 	= $codigo;
			$alun 	= ucwords(strtolower($nome));
			$situ 	= $situacao;
			
			// Inserção no banco de dados
			$sql = mysql_query("SELECT `alunonum`,`alunonome`,`situ_alun` FROM `defesa` WHERE `defesanum` = '" .$id ."' AND `situ_defe` = 1 ;");
			$res = mysql_num_rows($sql);
			
			if($res == 1){				
				$update = mysql_query("UPDATE `defesa` SET `situ_defe` = '" . 0 . "' WHERE `defesanum` = '" .$id ."'");
			}else{
				$flash = "Desculpa mas essa Defesa já foi desativado!";
			}
			if(isset($update)){
				$flash = "Atualizacao realizada com sucesso!";
			}else{
				if($flash == ""){
					$flash = "Houve um erro na Atualizacao!";
				}
			}
			// Retorno para o usuário
			echo '<script> alert("' .$flash .'");history.back();</script>';
		}
		
		public function altapr(){
		    // Tratamento das variaveis
			$id 	= $codigo;
			$alun 	= ucwords(strtolower($nome));
			$situ 	= $situacao;
			
			// Inserção no banco de dados
			$sql = mysql_query("SELECT `apresnum`,`alunonome`,`situ_apre` FROM `apres` WHERE `apresnum` = '" .$id ."' AND `situ_apre` = 1 ;");
			$res = mysql_num_rows($sql);
			
			if($res == 1){				
				$update = mysql_query("UPDATE `apres` SET `situ_alun` = '" . 0 . "' WHERE `alunonum` = '" .$id ."'");
			}else{
				$flash = "Desculpa mas essa Apresentacao já foi atualizada!";
			}
			if(isset($update)){
				$flash = "Atualizacao realizada com sucesso!";
			}else{
				if($flash == ""){
					$flash = "Houve um erro na Atualizacao!";
				}
			}
			// Retorno para o usuário
			echo '<script> alert("' .$flash .'");history.back();</script>';
		}
	}
?>