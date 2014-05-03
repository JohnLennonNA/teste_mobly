<?php 
	session_start();
	include("conexao.php"); 
	header ('Content-type: text/html; charset=ISO-8859-1');
?>

<!doctype html>
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
				<form action="buscar.php" method="get">
					<input type="text" name="busca" required>
					<input type="submit" value="Buscar">
				</form>
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
			<h3>Produtos</h3>
			<?php 
				
				if(isset($_GET['categ'])) :
					$sql = "SELECT p.* FROM produto as p INNER JOIN rel_produto_categoria as rl on (p.id_produto = rl.id_produto ) WHERE rl.id_categoria = ".$_GET['categ'];
				else :
					$sql = "SELECT * FROM produto";
				endif;

				$result = mysql_query($sql);
				while($dados = mysql_fetch_assoc($result)) :
			?>

				<div class="celula_produto">
					<a href="detalhes.php?prod=<?php echo $dados['id_produto'] ?>">
						<img src="imagem_produtos/<?php echo $dados['imagem_produto'];  ?>" alt="" width="100" height="100">
						<p class="titulo"><?php echo $dados['nome_produto']; ?></p>
						<p class="preco">R$ <?php echo number_format($dados['preco_produto'], 2, ".",",") ?></p>
					</a>
				</div>

			<?php endwhile; ?>
		</section>
		
	</div>
</section>


</body>
</html>