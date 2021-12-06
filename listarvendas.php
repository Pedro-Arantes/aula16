<?php
include('conexao.php');

try{
    $sql = "SELECT * from tblvendas";
    $qry = $con->query($sql);
    $vendas = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($clientes);
    //die();
} catch(PDOException $e){
    echo $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Vendas</title>
</head>
<body>
    
<h1>Lista de Vendas</h1>
<hr>
<a href="frmvenda.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>id venda</th> 
           <th>id vendedor</th>
           <th>id produto</th>
           <th>Quantidade</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($vendas as $vendas) { ?>
        <tr>
            <td><?php echo $vendas->idvendas ?></td>
            <td><?php echo $vendas->idvendedor ?></td>
            <td><?php echo $vendas->idproduto ?></td>
            <td><?php echo $vendas->qtd ?></td>
            <td><a href="frmvenda.php?idvendas=<?php echo $vendas->idvendas ?>">Editar</a></td>
            <td><a href="frmvenda.php?op=del&idvendas=<?php echo  $vendas->idvendas ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>