<?
	class Consulta{
		public function conalu($id, $nome){
			// Tratamento das variaveis
			$nome = ucwords(strtolower($nome));
			
			// Inserção no banco de dados
			$valida = mysql_query("SELECT * FROM `aluno` WHERE `alunonome` = '" .$nome ."';");
			$contar = mysql_num_rows($valida);
			
			if($contar == 0){
				// $insert = mysql_query("INSERT INTO `aluno` (`alunonum`, `alunonome`) VALUES (null, '" .$nome ."')");
				$flash = "O usuário não existe no sistema!";
			}else{
				$flash = "O aluno já está cadastrado!";
			}
			if(isset($insert)){
				$flash = "Consulta realizada com sucesso!";
			}else{
				if($flash==""){
					$flash = "Houve um erro na Consulta!";
				}
			}
			// Retorno para o usuário
			echo $flash;
		}
		
		public function conban(){
		    
		}
		
		public function condef(){
		    
		}
		
		public function conapr(){
		    
		}
	}
?>