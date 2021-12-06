<?php 

$idvendas = isset($_GET["idvendas"]) ? $_GET["idvendas"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdsistema";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  tblvendas where idvendas= :idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendas",$idvendas);
            $stmt->execute();
            header("Location:listarvendas.php");
        }


        if($idvendas){
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  tblvendas where idvendas= :idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendas",$idvendas);
            $stmt->execute();
            $vendas = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($cliente);
        }
        if($_POST){
            if($_POST["idvendas"]){
                $sql = "UPDATE tblvendas SET idvendedor=:idvendedor, idproduto=:idproduto,qtd=:qtd WHERE idvendas =:idvendas";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idvendedor", $_POST["idvendedor"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue(":qtd", $_POST["qtd"]);
                $stmt->bindValue(":idvendas", $_POST["idvendas"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO tblvendas(idvendedor,idproduto,qtd) VALUES (:idvendedor,:idproduto,:qtd)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idvendedor",$_POST["idvendedor"]);
                $stmt->bindValue(":idproduto",$_POST["idproduto"]);
                $stmt->bindValue(":qtd",$_POST["qtd"]);
                $stmt->execute(); 
            }
            header("Location:listarvendas.php");
        } 
    } catch(PDOException $e){
         echo "erro".$e->getMessage;
        }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de Vendas</title>
</head>
<body>
<h1>Cadastro de Vendas</h1>
<form method="POST">
Numero de Identificação do Vendedor  <input type="text" name="idvendedor"        value="<?php echo isset($vendas) ? $vendas->idvendedor : null ?>">
<br>

Numero de Identificação do produto <input type="text" name="idproduto"       value="<?php echo isset($vendas) ? $vendas->idproduto : null ?>">
<br>

Quantidade <input type="text" name="qtd"       value="<?php echo isset($vendas) ? $vendas->qtd : null ?>">
<br>

<input type="hidden"     name="idvendas"   value="<?php echo isset($vendas) ? $vendas->idvendas : null ?>">
<input type="submit">
</form>
<a href="listarvendas.php">volta</a>
</body>
</html>