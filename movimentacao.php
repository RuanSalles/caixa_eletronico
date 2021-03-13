<?php

session_start();

require 'config.php';

if(isset($_POST['tipo'])) {
	$tipo = $_POST['tipo'];
	$valor = str_replace(",", ".", $_POST['valor']);
	$valor = floatval($valor);

	$sql = $pdo->prepare("INSERT INTO historico (id_conta, tipo, valor, data_operacao) VALUES (:id_conta, :tipo, :valor, NOW())");
	$sql->bindValue(":id_conta", $_SESSION['banco']);
	$sql->bindValue(":tipo", $tipo);
	$sql->bindValue(":valor", $valor);
	$sql->execute();

	if($tipo == '0') {
		// Depósito
		$sql = $pdo->prepare("UPDATE conta SET saldo = saldo + :valor WHERE id = :id");
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":id", $_SESSION['banco']);
		$sql->execute();

	} else {
		// Saque
		$sql = $pdo->prepare("UPDATE conta SET saldo = saldo - :valor WHERE id = :id");
		$sql->bindValue(":valor", $valor);
		$sql->bindValue(":id", $_SESSION['banco']);
		$sql->execute();
	}

	header("Location: index.php");
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar transação</title>
</head>
<body>
    <br>
<div class="container">
<form method="POST" class="form-group">

<h1>Tipo de transação <br><br></h1>

<select name="tipo" class="form-control form-control-lg" >
<option value="0">Depósito</option>
<option value="1">Saque</option>


</select> <br><br>

Valor: <br>
<input class="form-control" type="text" name="valor" pattern="[0-9,.]{1,}"><br><br>
<input class="btn btn-primary" type="submit" value="Realizar Operação">


</form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>