<?php
    //INICIALIZAÇÂO
    require_once("menu.php");
    
    session_start();
    if(!isset($_SESSION["cadastros"])) {
        $_SESSION["cadastros"] = array();
    }
    setlocale(LC_ALL, "pt_BR", "ptb");
    
    //OBTER DADOS DO FORUMLARIO
    $nome = $_REQUEST["nome"];
    $estado = $_REQUEST["estado"];
    $observacoes = $_REQUEST["observacoes"];
    $telefone = $_REQUEST["telefone"];
    $cpf = $_REQUEST["cpf"];
    $email = $_REQUEST["email"];
    $site = $_REQUEST["site"];
    
    
    $sexo = null;
    if(isset($_REQUEST["sexo"])){
        $sexo = $_REQUEST["sexo"];
    }
    
    $aceito = false;
    if(isset($_REQUEST["aceito"])) {
        $aceito = true;
    }
    
    //VALIDAÇÃO
    $camposValidados = true;
    
    if($sexo == null){
        echo "Selecione uma opcao para o campo sexo ! <br/>";
        $camposValidados = false;
    }
    
    if($estado== -1){
        echo "Por favor , selecione uma opcao para o estado ! <br/>";
        $camposValidados = false;
    }
    
    
    $nome = trim ($nome);
    if(empty($nome)){
        echo "Preencha o nome no campo ! <br/>";
        $camposValidados = false;
    }
    
    if(!ctype_alpha ($nome)){
        echo "Digite somente letras !<br/>";
        $camposValidados = false;        
    }
    
    $observacoes = trim ($observacoes);
    if(empty($observacoes)){
        echo "Preencha as observacoes no campo ! <br/>";
        $camposValidados = false;
    }
    
     else if(!ctype_alnum ($observacoes)){
        echo "Digite letras e numeros !<br/>";
        $camposValidados = false;        

    }
    
    $telefone = trim ($telefone);
    if(empty($telefone)){
        echo "Preencha o telefone no campo ! <br/>";
        $camposValidados = false;
    }
    else if(strlen($telefone) != 8){
        echo "Tamanho inválido ! <br/>";
        $camposValidados = false;        
    }
    
     if(!ctype_digit ($telefone)){
        echo "Digite somente numeros !<br/>";
        $camposValidados = false;
    }

    
    $cpf = trim ($cpf);
    if(empty($cpf)){
        echo "Preencha o cpf no campo ! <br/>";
        $camposValidados = false;
    }
    
        else if(strlen($cpf) != 14 and strlen($cpf) != 11){
        echo "Tamanho inválido ! <br/>";
        $camposValidados = false;        
    }
    
    $email = trim ($email);
     if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo "Email invalido! <br/>";
            $camposValidados = false;
        }
        
    $site = trim ($site);
     if(!filter_var($site,FILTER_VALIDATE_URL)){
        echo "Site invalido! <br/>";
            $camposValidados = false;
        }
        
        
    //CADASTRO
    if($camposValidados){
        $pessoa = array();
        $pessoa["nome"] = $nome;
        $pessoa["sexo"] = $sexo;
        $pessoa["aceito"] = $aceito;
        $pessoa["estado"] = $estado;
        $pessoa["observacoes"] = $observacoes;
        $pessoa["telefone"] = $telefone;
        $pessoa["cpf"] = $cpf;
        $pessoa["email"] = $email;
        $pessoa["site"] = $site;

        
        array_push($_SESSION["cadastros"], $pessoa);
        
        echo "Cadastro efetuado com sucesso. <br/>Cadastre outra pessoa!";
    }
    else{
        echo "<br/>";
        echo "<input type='button' value='Voltar' onclick='history.go(-1)' />";
    }
?>
