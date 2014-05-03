<?php 
	session_start();
	include("conexao.php"); 
	header ('Content-type: text/html; charset=ISO-8859-1');

if(isset($_GET['prod']))
{
	$sql = "SELECT * FROM produto WHERE id_produto = ".$_GET['prod'];
	$result = mysql_query($sql);
	$dados = mysql_fetch_assoc($result);
}

$flag = 0;


if(isset($_POST['prod']))
{
	$produto = $_POST['prod'];

	$_SESSION["produtos"][] = $_POST['prod'];
	$_SESSION["carrinho"][$produto]['nome'] = $_POST['nome'];
	$_SESSION["carrinho"][$produto]['qtd'] = $_POST['qtd'];
	$_SESSION["carrinho"][$produto]['valor'] = $_POST['valor'];

}

// echo "<pre>";
// print_r($_SESSION["carrinho"]);
// echo "</pre>";

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $dados['nome_produto']; ?></title>

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
		
		<aside>
			<h3>Lista de categorias</h3>	
			<ul>
				<?php 
					$sqlc = "SELECT * FROM categoria";
					$resultc = mysql_query($sqlc);
					while($dadosc = mysql_fetch_assoc($resultc)) :
				?>
					<li><a href="lista_produtos.php?categ=<?php echo $dadosc['id_categoria']; ?>"><?php echo $dadosc['nome_categoria']; ?></a></li>
				<?php endwhile; ?>
				
			</ul>
		</aside>




		<section class="content">
					<h3><?php echo $dados['nome_produto']; ?></h3>
					<img src="imagem_produtos/<?php echo $dados['imagem_produto'];  ?>" alt="" width="300"><br>
					<p class="titulo"><?php echo $dados['descricao_produto']; ?></p><br>
					
					<p class="preco">R$ <?php echo number_format($dados['preco_produto'], 2, ".",",") ?></p><br>

					<form action="" method="post">
						<label for="">Quatidade<input type="text" name="qtd"></label>
						<input type="hidden" name="prod" value="<?php echo $dados['id_produto']; ?>">
						<input type="hidden" name="valor" value="<?php echo $dados['preco_produto']; ?>">
						<input type="hidden" name="nome" value="<?php echo $dados['nome_produto']; ?>">
						<input type="submit" value="Adcionar ao Carrinho" >
					</form>



<!-- 				<div class="celula_produto">
					<a href="detalhes.php?prod=<?php echo $dados['id_produto'] ?>">
						<img src="imagem_produtos/<?php echo $dados['imagem_produto'];  ?>" alt="" width="100" height="100">
						<p class="titulo"><?php echo $dados['nome_produto']; ?></p>
						<p class="preco">R$ <?php echo number_format($dados['preco_produto'], 2, ".",",") ?></p>
					</a>
				</div>
 -->
		</section>
		
	</div>
</section>




	
</body>
</html>