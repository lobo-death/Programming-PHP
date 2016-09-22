<form action="" method="POST">
	<!-- view -->
	
	<!-- Caixas de texto que receberão os valores da classe cliente -->
	<table align="center">
		<tr><td>&nbsp;</td><td><b>Formul&aacute;rio</b></td></tr>
		<tr><td>Nome:    </td><td><input type="text" name="nome"></td></tr>
		<tr><td>Endereco:</td><td><input type="text" name="ende"></td></tr>
		<tr><td>Email:   </td><td><input type="text" name="mail"></td></tr>
		<tr><td>Telefone:</td><td><input type="text" name="fone"></td></tr>
		<tr><td></td><td><button type="submit">Enviar</button></td></tr>
	</table>
</form>

<?php
/*
*	caso haja o preenchimento dos dados e a submissão do formulário, o controller,
*	será chamado para interpretar a ação.
*/
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require("../controller/cliente.php");
	}
	
	// define variaveis e usa o objeto criado no model
	?>
	<table align="center" border="1">
		<tr>
			<td>
				<?php 
					$nome = $cliente->getNome();
					echo "Nome:" 
				?>
			</td>
			<td> 
				<?php 
					echo " $nome <br>";
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php 
					$ende = $cliente->getEndereco();
					echo "Endereco:" 
				?>
			</td>
			<td> 
				<?php 
					echo " $ende <br>";
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php 
					$mail = $cliente->getEmail();
					echo "e-Mail:" 
				?>
			</td>
			<td> 
				<?php 
					echo " $mail <br>";
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php 
					$fone = $cliente->getTelefone();
					echo "Telefone:" 
				?>
			</td>
			<td> 
				<?php 
					echo " $fone <br>";
				?>
			</td>
		</tr>
	</table>
	<?php
		echo 'Foram encontrados: ' . mysql_num_rows($connect->executar()) . ' Schemas em seu banco de dados';
	?>
	
	<?php
	
?>
