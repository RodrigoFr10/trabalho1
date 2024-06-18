<?php
require_once "conexao.php";

$nome=$_GET['n'];
$id=$_GET['id'];
echo "<div class=topo><p>Bem-vindo, ",$nome,"</p></div>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua conta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Seus Pedidos</h2>
            
<?php
    $pdds=selectDados($connect,'pedidos',"cliente_id=$id");
    foreach($pdds as $p){
        echo "<hr>Pedido ",$p['id']," | Endereço: ",$p['endereco'], " | Horário: ",$p['horario'];
    }
?>

<h2>Fazer novo pedido</h2>
<form name="pedido" method="POST" action="conexao.php?cadPed&id=<?php echo $id ?>">
    <label for="endereco">Endereço: </label>
    <input type="text" name="inputEnd"><br><br>

    <label for="endereco">Data/Horário: </label>
    <input type="datetime-local" name="inputHora"><br><br>
    <label for="endereco">Quantidade: </label>
    <input type="number" name="inputQuant"><br><br>

    <label for="endereco">Produto disponíveis: </label>
    <select name="inputProd">
        <?php
            /*$clientes=selectDados($connect,"clientes","ano!=2023 ORDER BY ano DESC");*/
            $produto=selectDados($connect,"produtos","quantidade>0");
            
            foreach($produto as $pro){
        ?>
        
        <option value="<?php echo $pro['id'] ?>"><?php echo $pro['nome'],'(', $pro['id'],') por R$',$pro['preco'] ?></option>
    
        
        <?php
            }
        ?>
    </select>
    
    <input type="submit" name="fazerPedido" value="Enviar">
</form>
</body>
</html>