<?php

class conexao {
	//Informações do banco de dados
	var $host = "localhost";
	var $user = "root";
	var $senha = "";
	var $dbase = "phconfeccoes";

	//Variáveis para usar
	var $query;
	var $link;
	var $resultado;

	function MySql() {
		//Instancia o objeto para usarmos
	}

	//Funcao que faz a conexao
	function conexao() {
		$this -> link = mysql_connect($this -> host, $this -> user, $this -> senha);
		//Conecta ao banco de dados
		
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		//seta caracteres
		
		if (!$this -> link) {
			//Caso erro
			print("Ocorreu um erro ao selecionar o banco:");
			print("<b>" . mysql_error() . "</b>");
			die();
		} elseif (!mysql_select_db($this -> dbase, $this -> link)) {
			// Seleciona o banco após a conexão
			// Caso ocorra um erro, exibe uma mensagem com o erro
			print "Ocorreu um Erro em selecionar o Banco:";
			print "<b>" . mysql_error() . "</b>";
			die();
		}
	}

	function sql_query($query) {
		$this -> conexao();
		$this -> query = $query;
		//Conecta e faz a query no mysql
		if ($this -> resultado = mysql_query($this -> query)) {
			$this -> desconecta;
			return $this -> resultado;
		} else {
			//Caso ocorra algum erro, exibe a mensagem com erro
			print "Ocorreu um erro ao executar a query mysql: <b>$query</b>";
			print "<br /> <br />";
			print "Erro no mysql: <b>" . mysql_error() . "</b>";
			die();
			$this -> desconecta;
		}
	}

	//Funcao para desconectar do banco de dados
	function desconecta() {
		return mysql_close($this -> link);
	}

}




/* INICIO LOGIN SITE ============================================================ */

$_BR['Tabela'] = "com_membros";
$_BR['PaginaLogin'] = "./login";
$_BR['CaseSensitive'] = true;
$_BR['AbreSessao'] = true;
$_BR['ValidaSempre'] = true;

if ($_HP['AbreSessao'] == true) {
	@session_start();
}




function validaUsuarioSite($XUsuario, $XSenha) {
	global $_BR;

	$cS = ($_BR['CaseSensitive']) ? 'BINARY' : '';
	$Usuario = addslashes($XUsuario);
	$Senha = addslashes($XSenha);

	$mysql = new conexao;
	$Procura = "SELECT * FROM " . $_BR['Tabela'] . " WHERE (" . $cS . " Usuario = '" . $Usuario . "' AND " . $cS . " Senha = '" . md5($Senha) . "') AND Status='1' LIMIT 1";
	$mysql -> desconecta;
	$query = mysql_query($Procura);
	$Resultado = mysql_fetch_assoc($query);

	if (empty($Resultado)) {
		return false;
	} else {

		$_SESSION['MembroID'] = $Resultado['id'];
		$_SESSION['Status'] = $Resultado['Status'];
		$_SESSION['Senha'] = $Resultado['Senha'];
		$_SESSION['Chave'] = $Resultado['Chave'];
		$_SESSION['Membro'] = $Resultado['Usuario'];
		$_SESSION['Nome'] = $Resultado['Nome'];
		$_SESSION['Sobrenome'] = $Resultado['Sobrenome'];
		$_SESSION['Endereco'] = $Resultado['Endereco'];
		$_SESSION['Cep'] = $Resultado['Cep'];
		$_SESSION['Cidade'] = $Resultado['Cidade'];
		$_SESSION['Telefone'] = $Resultado['Telefone'];
		$_SESSION['Cpf'] = $Resultado['Cpf'];
		$_SESSION['FotoPerfil'] = $Resultado['FotoPerfil'];
		$_SESSION['DataDeCadastro'] = $Resultado['DataDeCadastro'];

		if ($_BR['ValidaSempre'] == true) {

			$_SESSION['MembroLogin'] = $Membro;
			$_SESSION['MembroSenha'] = $Senha;
			
		}

		return true;
	}
}

function protegePaginaSite() {
	global $_BR;
	if (!isset($_SESSION['MembroID']) OR !isset($_SESSION['Membro'])) {
		expulsaVisitanteSite();
	} else if (!isset($_SESSION['MembroID']) OR !isset($_SESSION['Membro'])) {
		if ($_BR['ValidaSempre'] == true) {
			if (!validaUsuario($_SESSION['MembroLogin'], $_SESSION['MembroSenha'])) {
				expulsaVisitanteSite();
			}
		}
	}
}

function AtualizaDados($XUsuario, $XSenha) {
	global $_BR;
	unset($_SESSION['MembroID'], $_SESSION['Membro'], $_SESSION['MembroLogin'], $_SESSION['MembroSenha']);
	$sec = "3";
	//header("Refresh: $sec; url=./login");
	if ($Login == true) {
	$Error = "2";
	}else{
	$Error = "1";
	}
}

function expulsaVisitanteSite() {
	global $_BR;
	unset($_SESSION['MembroID'], $_SESSION['Membro'], $_SESSION['MembroLogin'], $_SESSION['MembroSenha']);
	header("Location: " . $_BR['PaginaLogin']);
}


/* FIM LOGIN SITE ============================================================ */

/* Administracao Seguranca */
$_HP['Tabela'] = "com_administracao";
$_HP['PaginaLogin'] = "admin.php";
$_HP['CaseSensitive'] = true;
$_HP['AbreSessao'] = true;
$_HP['ValidaSempre'] = true;

if ($_HP['AbreSessao'] == true) {
	@session_start();
}




function validaUsuario($XUsuario, $XSenha) {
	global $_HP;

	$cS = ($_HP['CaseSensitive']) ? 'BINARY' : '';
	$Usuario = addslashes($XUsuario);
	$Senha = addslashes($XSenha);

	$mysql = new conexao;
	$Procura = "SELECT id, Usuario FROM " . $_HP['Tabela'] . " WHERE (" . $cS . " Usuario = '" . $Usuario . "' AND " . $cS . " Senha = '" . md5($Senha) . "') LIMIT 1";
	$mysql -> desconecta;
	$query = mysql_query($Procura);
	$Resultado = mysql_fetch_assoc($query);

	if (empty($Resultado)) {
		return false;
	} else {

		$_SESSION['UsuarioID'] = $Resultado['id'];
		$_SESSION['Usuario'] = $Resultado['Usuario'];

		if ($_HP['ValidaSempre'] == true) {

			$_SESSION['UsuarioLogin'] = $Usuario;
			$_SESSION['UsuarioSenha'] = $Senha;
		}

		return true;
	}
}

function protegePagina() {
	global $_HP;
	if (!isset($_SESSION['UsuarioID']) OR !isset($_SESSION['Usuario'])) {
		expulsaVisitante();
	} else if (!isset($_SESSION['UsuarioID']) OR !isset($_SESSION['Usuario'])) {
		if ($_HP['ValidaSempre'] == true) {
			if (!validaUsuario($_SESSION['UsuarioLogin'], $_SESSION['UsuarioSenha'])) {
				expulsaVisitante();
			}
		}
	}
}

function expulsaVisitante() {
	global $_HP;
	unset($_SESSION['UsuarioID'], $_SESSION['Usuario'], $_SESSION['UsuarioLogin'], $_SESSION['UsuarioSenha']);
	header("Location: " . $_HP['PaginaLogin']);
}
?>