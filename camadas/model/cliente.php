<?php
	class Cliente{
		// model 
		
		// propriedades da classe objeto
		private $nome;
		private $endereco;
		private $email;
		private $telefone;
		
		// setters e getters
		public function setNome ($nome){
			$this->nome = $nome;
		}
		public function getNome (){
			return $this->nome;
		}
		
		public function setEndereco ($endereco){
			$this->endereco = $endereco;
		}
		public function getEndereco (){
			return $this->endereco;
		}
		
		public function setEmail ($email){
			$this->email = $email;
		}
		public function getEmail (){
			return $this->email;
		}
		
		public function setTelefone ($telefone){
			$this->telefone = $telefone;
		}
		public function getTelefone (){
			return $this->telefone;
		}
		
		public function salvar(){
			// logica necessária para salvar
		}
		public function excluir(){
			// logica necessária para excluir
		}
		public function selecionar(){
			// logica necessária para selecionar
		}
	}
?>