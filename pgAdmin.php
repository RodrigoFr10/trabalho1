<?php
/*O usuário chamado admin será direcionado para esta página*/
require_once "conexao.php";

$nome=$_GET['n'];
echo "<div class=topo><p>Bem-vindo, ",$nome,"</p></div>";
?>

<!DOCTYPE html>
<html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página administrativa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table,td{border:1px solid black;
                 border-collapse:collapse;
        }
    </style>
     <script src="myscripts.js"></script> 
</head>
<body>
<h2>Produtos</h2>
        <table>
            <tr>
                <td>ID</td>
                <td>Produto</td>
                <td>Preço</td>
                <td>Quantidade</td>
                <td>Categoria</td>
            </tr>
        <?php
        $prod=selectDados($connect,'produtos');
        
        foreach ($prod as $pr){
            $thisID=$pr['categoria_id'];
            
            $categoria=selectDados($connect,'categorias',"id=$thisID");
            foreach ($categoria as $cat){
                if($cat['id']=$pr['categoria_id']){
                    $catNome=$cat['nome'];
                    $catID=$cat['id'];
                    break;
                }
            }
            
            ?>
            <tr>
                <td><?php echo $pr['id']; ?></td>
                <td><?php echo $pr['nome']; ?></td>
                <td><?php echo $pr['preco'],'R$'; ?></td>
                <td><?php echo $pr['quantidade']; ?></td>
                <td><?php echo $catNome,'(',$catID,')'; ?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <h2>Adicionar novo Produto</h2>
        <form name="cadastrarProduto"  method="POST" action="conexao.php?cadProd">
            <label for="inputNome">Nome:</label>
            <input type="text" name="inputNome"><br><br>

            <label for="inpuPreco">Preço:</label>
            <input type="number" name="inputPreco"><br><br>

            <label for="inputQuant">Quantidade:</label>
            <input type="number" name="inputQuant"><br><br>

            <label for="inputCat">Categoria:</label>
            <select name="inputCat"><br><br>

                <?php
                    /*$clientes=selectDados($connect,"clientes","ano!=2023 ORDER BY ano DESC");*/
                    $categoria=selectDados($connect,"categorias");
                    
                    foreach($categoria as $cat){
                ?>
        
                <option value="<?php echo $cat['id'] ?>"><?php echo $cat['nome'],'(', $cat['id'],')' ?></option>
            
                </div>
                <?php
                    }
                ?>
            </select>
            <input type="submit" name="cadastroProd" value="Enviar">
        </form>




        <h2>Remover Produto</h2>
        <form name="removerProduto"  method="POST" action="conexao.php?remProd">
            <select name="inputProd">
                <?php
                    
                    $produto=selectDados($connect,"produtos");
                    
                    foreach($produto as $p){
                ?>
        
                <option value="<?php echo $p['id'] ?>"><?php echo $p['nome'],'(', $p['id'],')' ?></option>
            
                </div>
                <?php
                    }
                ?>
            </select>
            <input type="submit" name="removeProd" value="Remover" style="background:red;border:2px solid black;">
        </form>

        <h2>Atualizar Produto</h2>
        
            <table>
            <tr>
                <td>ID</td>
                <td>Produto</td>
                <td>Preço</td>
                <td>Quantidade</td>
                <td>Categoria</td>
                <td> </td>
            </tr>
        <?php
        $prod=selectDados($connect,'produtos');
        
        foreach ($prod as $pr){
            $thisID=$pr['categoria_id'];
            
            $categoria=selectDados($connect,'categorias',"id=$thisID");
            foreach ($categoria as $cat){
                if($cat['id']=$pr['categoria_id']){
                    $catNome=$cat['nome'];
                    $catID=$cat['id'];
                    break;
                }
            }
            
            ?>
            <form name="atualizarProduto"  method="POST" action="http://localhost:3000/atualizarProd">
            <tr>
                <td><input type="number" name="inputId" style="width:40px;"value=<?php echo $pr['id']; ?>></td>
                <td><input type="text" name="inputNome" style="width:180px;"value="<?php echo $pr['nome']; ?>"></td>
                <td><input type="number" name="inputPreco" value=<?php echo $pr['preco']; ?>>R$</td>
                <td><input type="number" name="inputQuant" style="width:100px;" value=<?php echo $pr['quantidade']; ?>></td>
                <td><?php echo $catNome,'(',$catID,')'; ?></td>
                <td><input type="submit" name="atlProd" value="Atualizar">
                </td>
            </tr>
            </form>
            <?php
        }
        ?>
        </table><br>


        <h2>Adicionar nova categoria</h2>
        <form name="cadastrarCategoria"  method="POST" action="conexao.php?cadCat" >
            <label for="inputNome">Nome:</label>
            <input type="text" name="inputNome"><br><br>
            <input type="submit" name="cadastroCat" value="Enviar">
        </form>




        <h2>Pedidos</h2>
        <table>
            <tr>
                <td>ID</td>
                <td>Horário</td>
                <td>Endereço</td>
                <td>Cliente_id</td>
                <td>Preço(quantidade)</td>
                
                
            </tr>
        <?php
        $ped=selectDados($connect,'pedidos');
        
        foreach ($ped as $p){
            $thisID=$p['id'];
            
            $pedProd=selectDados($connect,'pedidos_produtos',"pedido_id=$thisID");
            foreach ($pedProd as $pp){
                if($p['id']=$pp['pedido_id']){
                    $ppPreco=$pp['preco'];
                    $ppQuant=$pp['quantidade'];
                    break;
                }
            }
            
            ?>
            <form name="atualizarProduto"  method="POST" action="conexao.php?admPed">
            <tr>
                <td><input type="number" name="inputId" style="width:40px;"value=<?php echo $p['id']; ?>></td>
                <td><input type="datetime-local" name="inputHora" style="width:180px;"value="<?php echo $p['horario']; ?>"></td>
                <td><input type="text" name="inputEnd" value="<?php echo $p['endereco']; ?>"></td>
                <td><input type="number" name="inputCliID" style="width:100px;" value=<?php echo $p['cliente_id']; ?>></td>
                <td><?php echo $ppPreco,'(',$ppQuant,')'; ?></td>
                <td><input type="submit" name="atlPed" value="Atualizar"></td>
                <td><input type="submit" name="delPed" style="background:red;border:2px solid black;" value="Deletar"></td>
            </tr>
            </form>
            <?php
        }
        ?>
        </table><br>



</body>
</html>