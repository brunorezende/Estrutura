<?php
function upload_imagem($img, $max_x, $max_y, $nome_foto) {
	list($width, $height) = getimagesize($img);
	$original_x = $width;
	$original_y = $height;
	// se a largura for maior que altura
	if ($original_x > $original_y) {
		$porcentagem = (100 * $max_x) / $original_x;
	}
	// se a altura for maior que a largura
	else {
		$porcentagem = (100 * $max_y) / $original_y;
	}
	$tamanho_x = $original_x * ($porcentagem / 100);
	$tamanho_y = $original_y * ($porcentagem / 100);
	$image_g = imagecreatetruecolor($tamanho_x, $tamanho_y);
	$image = imagecreatefromjpeg($img);
	imagecopyresampled($image_g, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height);
	return imagejpeg($image_g, $nome_foto, 100);
}


function getIp()
{
 
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
 
        $ip = $_SERVER['HTTP_CLIENT_IP'];
 
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
 
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
 
    }
    else{
 
        $ip = $_SERVER['REMOTE_ADDR'];
 
    }
 
    return $ip;
 
}
function ConverteData($dt) {
    $yr=strval(substr($dt,0,4));
    $mo=strval(substr($dt,5,7));
    $da=strval(substr($dt,8,9));
    $hr=strval(substr($dt,8,2));
    $mi=strval(substr($dt,10,2));
    $se=strval(substr($dt,12,2));
    return date("d/m/Y", mktime ($hr,$mi,$se,$mo,$da,$yr));
}

function upload_pdf($diretorio, $nome) {
	move_uploaded_file($nome, $diretorio);
}
//Status
function Status($Status) {
	if($Status == 1) {
		echo "Ativado";
	}
	else {
		echo "Desativado";
	}
}
//LastID
function LastID($Tabela, $Plus) {
	$mysql = new conexao;
	$sql = mysql_query("SELECT * FROM $Tabela ORDER BY -id");
	$mysql -> desconecta;
	$lastID = mysql_fetch_array($sql);
	$lastID = $lastID['id'] + $Plus;
	return $lastID;
}
//AntiInjection
function AntiInjection($sql) {
	//remove palavras com sintaxe sql
	$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i", '', $sql);
	//limpa espaco vazio
	$sql = trim($sql);
	//tira tags html e php
	$sql = strip_tags($sql);
	//adiciona barras invertidas
	$sql = addslashes($sql);
	//retorna $sql
	return $sql;
}
function ActiveLink($Page,$Link){
	if($Page == $Link){
		echo "class='active'";
	}
}
//Excluir
function ExcluirID($ExcluirID, $Tabela) {
	if ($ExcluirID == true) {
		$mysql = new conexao;
		$Excluir = $mysql -> sql_query("DELETE FROM " . $Tabela . " WHERE (id=" . $ExcluirID . ") ");
		$mysql -> desconecta;
		if ($Excluir == true) {
?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">
		×
	</button>
	Informações excluída com sucesso!
</div>
<?php } else { ?>
<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">
		×
	</button>
	Falha ao excluir as informações!
</div>
<?php } } } ?>