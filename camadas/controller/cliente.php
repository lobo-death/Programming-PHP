<?php
	require("../model/cliente.php");
	
	// controller
	
	// aguardando na variavel p os dados provenientes do formulario
	$p = $_POST;
	
	$cliente = new cliente();
	
	// os valores são passados para o objeto
	$cliente->setNome($p['nome']);
	$cliente->setEndereco($p['ende']);
	$cliente->setEmail($p['mail']);
	$cliente->setTelefone($p['fone']);
	
	include('../model/connectBD.php');
    
    $connect = new connectBD();
 
    $connect->set('bd','information_schema');
    $connect->set('host','localhost');
    $connect->set('usuario','root');
    $connect->set('senha','');
    $connect->set('sql','SELECT * FROM SCHEMATA S');
 
    $connect->conectar();
    $connect->selecionarDB();
?>