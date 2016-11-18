<?
	class Login{
		// Método para logar e criar sessão
		public function logar($usuario, $senha){
			
			if (session_id() === '') { //Se for vazio é porque não iniciou a sessão ainda
				$expira = 3600; // 1 hora
				session_set_cookie_params($expira);
				session_start();
				session_regenerate_id();
		
				// Atribui valor nos atributos
				$user = $usuario;
				$pass = $senha;
					
				// Verifica se o usuário/senha digitados existem
				$sql = mysql_query("SELECT `profnum`, `profnome`, `profnick`, `senha`, `nivel` FROM `prof` WHERE (`profnick` = '".$user ."') AND (`senha` = '". sha1($pass) ."') AND (`ativo` = 1) LIMIT 1");
					
				if(mysql_num_rows ($sql) == 0){
					// Não encontrou usuário no banco
					unset ($_SESSION['user']);
					unset ($_SESSION['pass']);
					session_destroy();
					header('location:../view/index.html');
				}else{
					// Encontrou usuário e senha no banco
					if(mysql_num_rows ($sql) > 0 ){
						$_SESSION['user'] = $user;
						$_SESSION['pass'] = $pass;
						header('location:../view/menu.php');
					}else{
						echo '<script>alert("Usuario ou Senha Invalidos!"); history.back(); </script>';
						unset ($_SESSION['user']);
						unset ($_SESSION['pass']);
						session_destroy();
					}
				}
			} else {
				unset ($_SESSION['user']);
				unset ($_SESSION['pass']);
				session_destroy();
				header('location:../view/index.html');
			}	
		}
		
		public function autenticar($user){
			// Atribui valor nos atributos
			$logado = $user;
			
			// Verifica se o usuário está logado
			$sql = mysql_query("SELECT `profnum`, `profnome`, `profnick`, `senha` FROM `prof` WHERE (`profnick` = '".$logado ."') LIMIT 1");
			
			$res = mysql_fetch_array($sql, MYSQL_BOTH);
			
			return $res;
		}
	}
?>