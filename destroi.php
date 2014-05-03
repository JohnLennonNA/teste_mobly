<?php 
session_start();
unset($_SESSION["carrinho"]);
unset($_SESSION["produtos"]);


header("location: lista_produtos.php");

 ?>