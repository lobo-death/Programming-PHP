<?
	class Cadastro{
		public function cadalu($id, $nome){
			// Tratamento das variaveis
			$nome = ucwords(strtolower($nome));
			
			// Recebe os atributos da sessão
			$login  = $_SESSION['user'];
			$sessao = session_id();
			$host   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$ipv4   = ($_SERVER['REMOTE_ADDR']);
			$serv   = gethostbyaddr($_SERVER['SERVER_ADDR']);
			$ipse   = ($_SERVER['SERVER_NAME']);
			
			// Inserção no banco de dados
			$valida = mysql_query("SELECT * FROM `aluno` WHERE `alunonome` = '" .$nome ."';");
			$contar = mysql_num_rows($valida);
			
			if($contar == 0){
				$insert = mysql_query("INSERT INTO `aluno` (`alunonum`, `alunonome`,`situ_alun`) VALUES (null, '" .$nome ."', 1)");
				$log 	= mysql_query("INSERT INTO `logs` (`id`, `login`, `ticket`, `registro`, `host`, `ipv4`, `server`, `ipserv`, `acao`, `status`) VALUES (NULL,'$login','$sessao', now(),'$host','$ipv4','$serv','$ipse', 'C', 1)");
			}else{
				$flash = "Desculpa mas já existe esse Aluno cadastrado!";
			}
			if(isset($insert)){
				$flash = "Cadastro do Aluno realizado com sucesso!";
			}else{
				if($flash==""){
					$flash = "Houve um erro no Cadastro do Aluno!";
				}
			}
			// Retorno para o usuário
			//echo $flash;
			echo '<script>alert("Cadastro do Aluno realizado com Sucesso!"); </script>';
			header("Location: ../view/menu.php");
		}
		
		public function cadpro($idpr, $prof, $nick, $senh, $emai){
			// Recebe os atributos da função
			$id	  = $idpr;
			$nome = $prof;
			$user = $nick;
			$pass = $senh;
			$mail = $emai;
			
			// Recebe os atributos da sessão
			$login  = $_SESSION['user'];
			$sessao = session_id();
			$host   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$ipv4   = ($_SERVER['REMOTE_ADDR']);
			$serv   = gethostbyaddr($_SERVER['SERVER_ADDR']);
			$ipse   = ($_SERVER['SERVER_NAME']);
			
			// Pesquisa se já existe o usuário no banco de dados
			$sql = mysql_query("SELECT * FROM `prof` WHERE `profnick` = '" .$nome ."' OR `email` = '" .$mail ."';");
						
			if(mysql_num_rows($sql) == 0){
				// Não encontrou usuário no banco
				$insert = mysql_query("INSERT INTO `prof` (`profnum`, `profnome`, `profnick`, `senha`, `email`, `nivel`, `ativo`, `cadastro`) VALUES (null, '$nome', '$user', '". sha1($pass) ."','$mail', 1, 0, now())");
				$log 	= mysql_query("INSERT INTO `logs` (`id`, `login`, `ticket`, `registro`, `host`, `ipv4`, `server`, `ipserv`, `acao`, `status`) VALUES (NULL,'$login','$sessao', now(),'$host','$ipv4','$serv','$ipse', 'C', 1)");
			}else{
				// Encontrou usuário no banco
				$flash = "Desculpa mas já existe esse Usuário cadastrado!";
			}
			if(isset($insert)){
				$flash = "Cadastro do Usuário realizado com sucesso!";
			}else{
				if($flash==""){
					$flash = "Houve um erro no Cadastro do Usuário!";
				}
			}
			// Retorno para o usuário
			// echo $flash;
			echo '<script>alert("Cadastro do Usuário realizado com Sucesso!"); </script>';
			header("Location: ../view/index.html");
		}
		
		public function cadban($id, $banca, $profe, $defesa, $tipobanca){
		    // Tratamento das variaveis
			$id = $id;
			$banc = $banca;
			$prof = $profe;
			$defe = $defesa;
			$tpba = $tipobanca;
			
			// Recebe os atributos da sessão
			$login  = $_SESSION['user'];
			$sessao = session_id();
			$host   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$ipv4   = ($_SERVER['REMOTE_ADDR']);
			$serv   = gethostbyaddr($_SERVER['SERVER_ADDR']);
			$ipse   = ($_SERVER['SERVER_NAME']);
			
			// Inserção no banco de dados
			$valida = mysql_query("SELECT * FROM `banca` WHERE `bancanum` = '" .$nome ."';");
			$contar = mysql_num_rows($valida);
			
			if($contar == 0){
				$insert = mysql_query("INSERT INTO `banca` (`id`, `bancanum`, `profnum`, `defesanum`, `bancatipo`,`situ_banc`) VALUES (null, '$id', '$banc', '$prof', '$defe', '$tpba',1)");
				$log 	= mysql_query("INSERT INTO `logs` (`id`, `login`, `ticket`, `registro`, `host`, `ipv4`, `server`, `ipserv`, `acao`, `status`) VALUES (NULL,'$login','$sessao', now(),'$host','$ipv4','$serv','$ipse', 'C', 1)");
			}else{
				$flash = "Desculpa mas já existe essa Banca cadastrada!";
			}
			if(isset($insert)){
				$flash = "Cadastro da Banca realizado com sucesso!";
			}else{
				if($flash==""){
					$flash = "Houve um erro no Cadastro da Banca!";
				}
			}
			echo '<script>alert("Cadastro da Banca realizado com Sucesso!"); </script>';
			header("Location: ../view/menu.php");
		}
		
		public function caddef(){
		    // Tratamento das variaveis
			$nome = ucwords(strtolower($nome));
			
			// Recebe os atributos da sessão
			$login  = $_SESSION['user'];
			$sessao = session_id();
			$host   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$ipv4   = ($_SERVER['REMOTE_ADDR']);
			$serv   = gethostbyaddr($_SERVER['SERVER_ADDR']);
			$ipse   = ($_SERVER['SERVER_NAME']);
			
			// Inserção no banco de dados
			$valida = mysql_query("SELECT * FROM `defesa` WHERE `defesatitulo` = '" .$nome ."';");
			$contar = mysql_num_rows($valida);
			
			if($contar == 0){
				$insert = mysql_query("INSERT INTO `defesa` (`defesanum`, `defesacurso`, `defesatitulo`, `defesaresumo`, `defesadata`, `defesahora`, `defesatipo`,`situ_defe`) VALUES (null, '" .$nome ."',1)");
				$log 	= mysql_query("INSERT INTO `logs` (`id`, `login`, `ticket`, `registro`, `host`, `ipv4`, `server`, `ipserv`, `acao`, `status`) VALUES (NULL,'$login','$sessao', now(),'$host','$ipv4','$serv','$ipse', 'C', 1)");
			}else{
				$flash = "Desculpa mas já existe essa Defesa cadastrada!";
			}
			if(isset($insert)){
				$flash = "Cadastro da Defesa realizado com sucesso!";
			}else{
				if($flash==""){
					$flash = "Houve um erro no Cadastro da Defesa!";
				}
			}
			// Retorno para o usuário
			//echo $flash;
			echo '<script>alert("Cadastro da Defesa realizado com Sucesso!"); </script>';
			header("Location: ../view/menu.php");
		}
		
		public function cadapr(){
		    // Tratamento das variaveis
			$defe = ucwords(strtolower($defesa));
			$alun = ucwords(strtolower($aluno));
			
			// Recebe os atributos da sessão
			$login  = $_SESSION['user'];
			$sessao = session_id();
			$host   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$ipv4   = ($_SERVER['REMOTE_ADDR']);
			$serv   = gethostbyaddr($_SERVER['SERVER_ADDR']);
			$ipse   = ($_SERVER['SERVER_NAME']);
			
			// Inserção no banco de dados
			$valida = mysql_query("SELECT * FROM `apres` WHERE `defesanum` = '" .$defe ."';");
			$contar = mysql_num_rows($valida);
			
			if($contar == 0){
				$insert = mysql_query("INSERT INTO `apres` (`apresnum`, `defesanum`, `alunonum`,`situ_apre`) VALUES (null, '" .$defe ."', '" .$alun ."',1)");
				$log 	= mysql_query("INSERT INTO `logs` (`id`, `login`, `ticket`, `registro`, `host`, `ipv4`, `server`, `ipserv`, `acao`, `status`) VALUES (NULL,'$login','$sessao', now(),'$host','$ipv4','$serv','$ipse', 'C', 1)");
			}else{
				$flash = "Desculpa mas já existe essa Apresentacao cadastrada!";
			}
			if(isset($insert)){
				$flash = "Cadastro da Apresentacao realizado com sucesso!";
			}else{
				if($flash==""){
					$flash = "Houve um erro no Cadastro da Apresentacao!";
				}
			}
			// Retorno para o usuário
			//echo $flash;
			echo '<script>alert("Cadastro da Apresentacao realizado com Sucesso!"); </script>';
			header("Location: ../view/menu.php");
		}
		
		public function cadcur($id, $curso, $periodo){
			// Tratamento das variaveis
			$curs = ucwords(strtolower($curso));
			$peri = ucwords(strtolower($periodo));
			
			// Recebe os atributos da sessão
			$login  = $_SESSION['user'];
			$sessao = session_id();
			$host   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$ipv4   = ($_SERVER['REMOTE_ADDR']);
			$serv   = gethostbyaddr($_SERVER['SERVER_ADDR']);
			$ipse   = ($_SERVER['SERVER_NAME']);
			
			// Inserção no banco de dados
			$valida = mysql_query("SELECT * FROM `cursos` WHERE `curso` = '" .$curs ."';");
			$contar = mysql_num_rows($valida);
			
			if($contar == 0){
				$insert = mysql_query("INSERT INTO `cursos` (`id`, `curso`, `periodo`,) VALUES (null, '" .$curs ."', '" .$peri ."')");
				$log 	= mysql_query("INSERT INTO `logs` (`id`, `login`, `ticket`, `registro`, `host`, `ipv4`, `server`, `ipserv`, `acao`, `status`) VALUES (NULL,'$login','$sessao', now(),'$host','$ipv4','$serv','$ipse', 'C', 1)");
			}else{
				$flash = "Desculpa mas já existe esse Curso cadastrado!";
			}
			if(isset($insert)){
				$flash = "Cadastro do Curso realizado com sucesso!";
			}else{
				if($flash==""){
					$flash = "Houve um erro no Cadastro do Curso!";
				}
			}
			// Retorno para o usuário
			//echo $flash;
			echo '<script>alert("Cadastro do Curso realizado com Sucesso!"); </script>';
			header("Location: ../view/menu.php");
		}
	}
?>