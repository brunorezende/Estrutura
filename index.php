<?php
include ("funcoes/conexao.php");
include ("funcoes/funcoes.php");
$page = @AntiInjection($_GET['page']);
include ("funcoes/page.php");
switch ($page) {
		// Padrão
		case empty($page) :
			$Titulo = "Início - ";
			break;
		//home
		case "home" :
			$Titulo = "Início - ";
			break;
			
		//SISTEMA DE USUARIOS
		case "cadastrar" :
			$Titulo = "Cadastro - ";
			break;
		case "confirmacadastro" :
			$Titulo = "Confirmação - ";
			break;
		case "recuperasenha" :
			$Titulo = "Recuperar Senha - ";
			break;
		case "alteradados" :
			$Titulo = "Alterar Dados - ";
			break;

		//empresa
		case "empresa" :
			$Titulo = "Empresa - ";
			break;
			
		//painel
		case "painel" :
		$Titulo = "Painel do Usuário - ";
			break;
			
		//produtos
		case "produtos" :
			$Titulo = "Produtos - ";
			break;
			
		//carrinho
		case "carrinho" :
			$Titulo = "Carrinho - ";
			break;
		//Login
		case "login" :
			$Titulo = "Login - ";
			break;
			
		//servicos
		case "servicos" :
			$Titulo = "Servicos - ";
			break;
			
		//projetos
		case "projetos" :
			$Titulo = "Projetos - ";
			break;
			
		//noticias
		case "noticias" :
			$Titulo = "Notícias - ";
			break;
			case "viewnoticia" :
				$Titulo = "Ver Notícia - ";
			break;
			
		//search
		case "search" :
			$Titulo = "Pesquisar - ";
			break;
		
		
		//contato
		case "contato" :
			$Titulo = "Contato - ";
			break;
			
		//Default
		default :
			$Titulo = "Início - ";
			break;
		}



	$ip = $_SERVER['REMOTE_ADDR'];
	$TabelaConf = "site_config";
	$mysql = new conexao;
	$ConfiguracaoSite = $mysql -> sql_query("SELECT * FROM ".$TabelaConf."");
	while ($GeraConfiguracaoSite = mysql_fetch_object($ConfiguracaoSite)) {
		$TituloConfig = $GeraConfiguracaoSite -> Titulo;
		$KeywordsConfig = $GeraConfiguracaoSite -> Keywords;
		$DescricaoConfig = $GeraConfiguracaoSite -> Descricao;
		$ServicosConfig = $GeraConfiguracaoSite -> Servicos;
		$CopyrightConfig = $GeraConfiguracaoSite -> Copyright;
		$TelefoneConfig = $GeraConfiguracaoSite -> Telefone;
		$EnderecoConfig = $GeraConfiguracaoSite -> Endereco;
		$CidadeConfig = $GeraConfiguracaoSite -> Cidade;
		$FotoContatoConfig = $GeraConfiguracaoSite -> FotoContato;
		$EmailConfig = $GeraConfiguracaoSite -> Email;
	}
	
	
				
  ?>
<!DOCTYPE html>
<html lang="pt">
	<?php
	include ("modulos/head/head.php");
	?>
	<body>
		<?php 
		include ("modulos/top/top.php"); 

		
//INICIO SETA PÀGINAS=========================================================================
	Page($page);
  //FIM SETA PÀGINAS=========================================================================

		include ("modulos/bottom/bottom.php"); 
		include ("modulos/scripts/scripts.php");
		?>
	</body>
</html>
