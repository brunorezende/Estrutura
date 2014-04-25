<?php
function Page($page) {
	switch ($page) {
		// Padrão
		case empty($page) :
			include ('componentes/principal/principal.php');
			break;
		//home
		case "home" :
			include ('componentes/principal/principal.php');
			break;
			
		
		//contato
		case "contato" :
			include ('componentes/contato/contato.php');
			break;
		//Default
		default :
			include ('componentes/principal/principal.php');
			break;
	}
}
?>
