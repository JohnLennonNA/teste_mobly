<?php
	$conexao = mysql_connect("localhost","root","") or print (mysql_error());
	mysql_select_db("mobly",$conexao) or print (mysql_error());
?>