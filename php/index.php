<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<h1>teste</h1>
	<?php
	$html = file_get_contents("https://www.jcnet.com.br/classificados");
	$tratado_1 = explode("section", $html);
	$tratado_2 = substr($tratado_1[1], 220);
	$tratado_3 = explode("</ul>", $tratado_2);
	$tratado_4 = explode('<li class="fluid">', $tratado_3[0]);

	// Remover item 0 do vetor, que continha uma sujeira
	unset($tratado_4[0]);

	foreach ($tratado_4 as $index => $conteudo) {
		$sub_linha = explode("</div>", $conteudo);
		$sub_linha1_limpo = str_replace("<div>", "", $sub_linha[0]);
		$sub_linha2_limpo = str_replace("</li>", "", $sub_linha[1]);

		echo $sub_linha1_limpo;
		echo "<br>";
		echo $sub_linha2_limpo;
		echo "<br>";
		echo "<br>";

		require("conecta.php");
		$data = date("Y-m-d");
		$mysqli->query("INSERT INTO tb_classificados VALUES ('', '$data', '$sub_linha1_limpo', '$sub_linha2_limpo')");
		echo $mysqli->error;
	}
	?>
</body>
</html>