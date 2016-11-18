function validalogin(){
 
    if(document.login.user.value == "" || document.login.user.value.length < 4){
        alert( "Preencha Usuário ou Senha corretamente!" );
        location.reload();
        document.login.user.focus();
        return false;
    }
    
    if( document.login.pass.value=="" || document.login.pass.value.length < 4 ){
        alert( "Preencha Usuário ou Senha corretamente!" );
        location.reload();
        document.login.pass.focus();
        return false;
    }
    return true;
}