<?php
require_once "conexao.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Loja</title>
<meta charset="utf-8"/>
<meta name="author" content="Rodrigo Franco"/>
<meta name="keywords" content="loja, vendas, produtos"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="icon" type="image/x-icon" href="Imagens/">

<link rel="stylesheet" href="style.css">

</head>
<body>

<nav class="menu">
    <ul>
        <li>Início</li>
        
    </ul>
</nav>
<div class="topo">
    <h1>Loja</h1>
    <p>
        Bem-vindo a loja
    </p>
</div>
<h2>Clientes</h2>
<?php
    /*$clientes=selectDados($connect,"clientes","ano!=2023 ORDER BY ano DESC");*/
    $clientes=selectDados($connect,"clientes");
    
    foreach($clientes as $c){
?>
<div>
    <hr>
    <p><?php echo 'Cliente ',$c['id'],' = Nome: ',$c['nome'], ', Altura: ',$c['altura'],', Cidade: ',$c['cidade_id']; ?></p>

        
</div>
<?php
   }
?>



<h2>Login</h2>
<form name="login" method="POST" action="conexao.php?login">
    <label for="inputNome">Nome:</label>
    <input type="text" name="inputNome"><br><br>

    <label for="inputNome">ID:</label>
    <input type="text" name="inputId"><br><br>
    
    <input type="submit" name="logon" value="Enviar">
</form>

<h2>Cadastrar</h2>
<form name="cadastro" method="POST" action="conexao.php?cadastrar"><!-- escrever o nome utilizado para REQUEST no php ? -->
    <label for="inputNome">Nome:</label>
    <input type="text" name="inputNome"><br><br>

    <label for="inputAlt">Altura(cm):</label>
    <input type="number" name="inputAlt" min="0" max=250><br><br>

    <label for="inputNasc">Data de nascimento:</label>
    <input type="date" name="inputNasc"><br><br>

    <label for="inputCid">Cidade:</label>
    <select name="inputCid"><br><br>

        <?php
            /*$clientes=selectDados($connect,"clientes","ano!=2023 ORDER BY ano DESC");*/
            $cidades=selectDados($connect,"cidades");
            
            foreach($cidades as $cid){
        ?>
        
        <option value="<?php echo $cid['id'] ?>"><?php echo $cid['nome'],'(', $cid['id'],')' ?></option>
         
        </div>
        <?php
            }
        ?>
    </select>
    <input type="submit" name="cadastro" value="Enviar">
</form>



</body>
</html>
