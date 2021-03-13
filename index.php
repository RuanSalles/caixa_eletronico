<?php
session_start();

require 'config.php';

if (isset($_SESSION['banco']) && !empty($_SESSION['banco'])) {
    $id = $_SESSION['banco'];

    $sql = $pdo->prepare("SELECT * FROM conta WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
        $info = $sql->fetch();
    } else {
        header('Location: login.php');
    }

} else {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Eletrônico</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
   
   <div class="container">
   <fieldset>
    <h1>Banco seu Bolso</h1>
    <h5>Agência: <?= $info['agencia']?> </h5> <br>
   <h5> Conta: <?= $info['contas']?> </h5><br>
    <h5>Titular: <?= $info['titular']?> </h5>  <br>
    <h5>Saldo: R$ <?= $info['saldo']?></h5> <br><br>

    <a class="btn btn-danger btn-lg" href="sair.php">Sair</a><br><br>
    </fieldset> 
    </div>

    <div class="container">
    <fieldset>
    <h3>Movimentação / Extrato</h3>

    <a class="btn btn-success btn-lg" href="movimentacao.php">Adicionar transação</a><br><br>

    <table border="1" width="400" class="table table-striped">
    
    <tr>
    <td>Data</td>
    <td>Valor</td>
    </tr>

    <?php

    $sql = $pdo->prepare("SELECT * FROM historico WHERE id_conta = :id_conta");
    $sql->bindValue(":id_conta", $id);
    $sql->execute();

    if($sql->rowCount() > 0) {
        foreach ($sql->fetchAll() as $item) {
            ?>
            <tr>
            <td> <?php echo date('d/m/Y H:i', strtotime($item['data_operacao'])); ?> </td>
            <td> <?php if($item['tipo'] == '0'): ?>
						<font color="green">R$ <?php echo $item['valor'] ?></font>
						<?php else: ?>
						<font color="red">- R$ <?php echo $item['valor'] ?></font>
						<?php endif; ?>
                        </td>
            </tr>

            <?php
        }
    }

    ?>
    
    </table>

    </fieldset>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>