<?php
include('conexao.php');

try{
    $sql = "SELECT * from tblvendedores";
    $qry = $con->query($sql);
    $vendedo = $qry->fetchAll(PDO::FETCH_OBJ);
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
    <title>Listar Vendedores</title>
</head>
<body>
    
<h1>Lista de Vendedores</h1>
<hr>
<a href="frmvendedores.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           
           <th>id vendedor</th>
           <th>Vendedor</th> 
           <th>Data de Admissão</th>
           <th>Salário</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($vendedo as $vendedo) { ?>
        <tr>
            <td><?php echo $vendedo->idvendedor ?></td>
            <td><?php echo $vendedo->vendedor ?></td>
            <td><?php echo $vendedo->dataadmissao ?></td>
            <td><?php echo $vendedo->salario ?></td>
            <td><a href="frmvendedores.php?idvendedor=<?php echo $vendedo->idvendedor ?>">Editar</a></td>
            <td><a href="frmvendedores.php?op=del&idvendedor=<?php echo  $vendedo->idvendedor ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>