<?php 

$idvendedor = isset($_GET["idvendedor"]) ? $_GET["idvendedor"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdsistema";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  tblvendedores where idvendedor = :idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            header("Location:listarvendedores.php");
        }


        if($idvendedor){
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  tblvendedores where idvendedor= :idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            $vendedor = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($cliente);
        }
        if($_POST){
            if($_POST["idvendedor"]){
                $sql = "UPDATE tblvendedores SET vendedor=:vendedor, dataadmissao=:dataadmissao, salario=:salario WHERE idvendedor =:idvendedor";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor", $_POST["vendedor"]);
                $stmt->bindValue(":dataadmissao", $_POST["dataadmissao"]);
                $stmt->bindValue(":salario", $_POST["salario"]);
                $stmt->bindValue(":idvendedor", $_POST["idvendedor"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO tblvendedores(vendedor,dataadmissao,salario) VALUES (:vendedor,:dataadmissao,:salario)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor",$_POST["vendedor"]);
                $stmt->bindValue(":dataadmissao",$_POST["dataadmissao"]);
                $stmt->bindValue(":salario",$_POST["salario"]);
                $stmt->execute(); 
            }
            header("Location:listarvendedores.php");
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
    <title>Formulario de Vendedores</title>
</head>
<body>
<h1>Cadastro de Vendedores</h1>
<form method="POST">
Vendedor <input type="text" name="vendedor"        value="<?php echo isset($vendedor) ? $vendedor->vendedor : null ?>"><br>
Data de admissão <input type="data" name="dataadmissao"       value="<?php echo isset($vendedor) ? $vendedor->dataadmissao : null ?>"><br>
Salário <input type="text" name="salario"       value="<?php echo isset($vendedor) ? $vendedor->salario : null ?>"><br>
<input type="hidden"     name="idvendedor"   value="<?php echo isset($vendedor) ? $vendedor->idvendedor : null ?>">
<input type="submit">
</form>
<a href="listarvendedores.php">volta</a>
</body>
</html>