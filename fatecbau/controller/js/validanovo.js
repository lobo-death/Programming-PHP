function validanovo(){

    if(document.novo.nome.value == "" || document.novo.nome.value.length < 4){
        alert( "Preencha o Nome corretamente!" );
        document.novo.nome.value='';
		document.novo.nome.focus();
        return false;
    }
 
    if(document.novo.user.value == "" || document.novo.user.value.length < 4){
        alert( "Preencha o Usuário corretamente!" );
        document.novo.user.value='';
		document.novo.user.focus();
        return false;
    }
    
    if( document.novo.pass.value=="" || document.novo.pass.value.length < 4 ){
        alert( "Preencha a Senha corretamente!" );
        document.novo.pass.value='';
		document.novo.word.value='';
		document.novo.pass.focus();
        return false;
    }
	
	if( document.novo.word.value=="" || document.novo.word.value.length < 4 ){
        alert( "Preencha a Confirmação da Senha corretamente!" );
        document.novo.pass.value='';
		document.novo.word.value='';
		document.novo.word.focus();
        return false;
    }
	
	if( document.novo.pass.value <> document.novo.word.value){
		alert( "Senha e Confirmação da Senha são diferentes!");
		document.novo.pass.value='';
		document.novo.word.value='';
		document.novo.pass.focus();
        return false;
	}
    return true;
}