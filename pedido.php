<?php 
	session_start();
	include("conexao.php"); 
	header ('Content-type: text/html; charset=ISO-8859-1');



if(isset($_POST['valortotal']))
{
	$sql = "INSERT INTO pedido (data_pedido,valor_pedido) VALUES (now(),".$_POST['valortotal'].")";
	mysql_query($sql);
	$id_pedido = mysql_insert_id();

	$looproduto = "";

	foreach ($_SESSION["produtos"] as $produto ) :
		$looproduto .= "(".$id_pedido.",".$produto."),";
	endforeach;

	echo $sql = "INSERT INTO detalhes_pedido (id_pedido,id_produto) VALUES ".substr($looproduto, 0 , -1);
	mysql_query($sql);

	unset($_SESSION["carrinho"]);
	unset($_SESSION["produtos"]);

	echo "<script>alert('Pedido criado com sucesso');</script>";

	header("location: lista_produtos.php");
}

?>


<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	
<header>
	<div class="center">
		<h1>Listagem de Produtos</h1>

		<div class="busca">
			<label for="">
				Buscar: 
				<input type="text" name="busca">
			</label>
		</div>

		<div class="carrinho">
			<img src="carrinho.fw.png" height="87" width="91">
			<p><span><?php echo @count($_SESSION["produtos"]); ?></span> produto(s) no carrinho</p>
			<a href="pedido.php">Criar Pedido</a>
			<a href="destroi.php">Esvaziar Carrinho</a>
		</div>

	</div>
</header>

<section>
	<div class="center">
		<table border="1">
			
		<tr>
			<td>Nome do produto</td>
			<td>Quantidade</td>
			<td>Valor unitário</td>
			<td>Valor Total</td>
		</tr>

		<?php 

		$totalgeral = 0;
		foreach ($_SESSION['carrinho'] as $produto): ?>

		<tr>
			<td><?php echo $produto['nome']; ?></td>
			<td><?php echo $produto['qtd']; ?></td>
			<td><?php echo $produto['valor']; ?></td>
			<td><?php echo $total = $produto['qtd'] * $produto['valor']; ?></td>
		</tr>

		<?php 

		$totalgeral += $total;
		endforeach ?>
		</table>

		Valor total do pedido : <?php echo $totalgeral; ?>

		<form action="" method="post">
			<input type="hidden" name="valortotal" value="<?php echo $totalgeral; ?>">
			<input type="submit" value="Finalizar Pedido">
		</form>

	</div>
</section>


</body>
</html>