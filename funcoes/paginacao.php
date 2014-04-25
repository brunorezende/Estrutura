<?php
$mysql = new conexao;
$sql = $mysql -> sql_query("SELECT COUNT(*) AS total FROM " . $Tabela . " " . $Condicao . " ORDER BY -id");
$total = mysql_result($sql, 0, 'total');
$paginas = (($total % $PorPagina) > 0) ? (int)($total / $PorPagina) + 1 : ($total / $PorPagina);

if ($PaginaAtual != false) {
	$pagina = (int)$PaginaAtual;
} else {
	$pagina = 1;
}
$pagina = max(min($paginas, $pagina), 1);
$inicio = ($pagina - 1) * $PorPagina;

$sql = $mysql -> sql_query("SELECT * FROM " . $Tabela . " " . $Condicao . " ORDER BY -id LIMIT " . $inicio . ", " . $PorPagina);

$Configuracao = $sql;
?>