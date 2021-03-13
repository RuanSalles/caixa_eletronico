<?php

require 'config.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Eletrônico - Cadastro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
   
   <div class="container">

   <br>
   <br>
   <fieldset>
    <form class="form-group" method="POST">
    Nome: <br>
    <input class="form-control" type="text" name="titular">
        Agência <br>
    <input class="form-control" type="text" name="agencia">
    Conta: <br>
    <input class="form-control" type="text" name="conta">
    Saldo Inicial:  <br>
    <input class="form-control" type="text" name="saldo">
    Senha <br>
    <input class="form-control" type="password" name="senha"><br>
    <input class="btn btn-primary" value="Cadastrar" type="submit"> <input class="btn btn-danger" value="Cancelar" type="reset"> 
    </form>
    
    
    </fieldset> 
    </div>

    <?php

    if (isset($_POST['titular']) && !empty($_POST['titular'])) {
    $titular = addslashes($_POST['titular']) ;
    $agencia = addslashes( $_POST['agencia']);
    $conta = addslashes($_POST['conta']) ;
    $senha = addslashes ($_POST['senha']);
    $saldo = str_replace(",", ".", $_POST['saldo']);
	$saldo = floatval($saldo);

    $sql = $pdo->prepare("INSERT INTO conta (titular,  agencia, contas, senha, saldo) VALUES (:titular, :agencia, :contas, :senha, :saldo)");
    $sql->bindValue(":titular" , $titular);
    $sql->bindValue(":agencia" , $agencia);
    $sql->bindValue(":contas" , $conta);
    $sql->bindValue(":senha" , md5($senha));
    $sql->bindValue(":saldo" , $saldo);
    $sql->execute();

    header('Location: index.php');
}

    ?>  

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>