<?php

session_start ();
require 'config.php';

if (isset($_POST['agencia']) && !empty($_POST['agencia'])) {
    $agencia = addslashes($_POST['agencia']);
    $conta = addslashes($_POST['conta']);
    $senha = addslashes($_POST['senha']);

    $sql = $pdo->prepare("SELECT * FROM conta WHERE agencia = :agencia AND contas = :contas AND senha = :senha");
    $sql->bindValue(":agencia", $agencia);
    $sql->bindValue(":contas", $conta);
    $sql->bindValue(":senha", md5($senha));
    $sql->execute();
    

    if($sql->rowCount() > 0) {
        $sql = $sql->fetch();


        $_SESSION['banco'] = $sql['id'];
        header('Location: index.php');
        exit;
    }

    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<br>
<br>
    <div class="container">
    <fieldset>
    <form method="POST" class="form-group">
    Agência: <br>
    <input class="form-control" type="number" name='agencia'><br><br>
    Conta: <br>
    <input class="form-control"  type="number" name='conta'><br><br>
    Senha <br>
    <input class="form-control"  type="password" name='senha'><br><br>

    <input class="btn btn-primary btn-lg" type="submit" value="Enviar"> <a class="btn btn-lg btn-warning" href="cadastrar.php">Cadastrar</a>

    </form>
    </fieldset>
    </div>

</body>
</html>