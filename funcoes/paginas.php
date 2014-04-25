<div class="pagination" id="pag">
		  <ul>
	<?php
	$Links = 5;
	if ($total > 1) {
		//echo "<li>Pagina $PaginaAtual de $paginas<br/>";
		echo "<li><a href=$Link&amp;pagina=1>&laquo;</a></li>";
		if ($PaginaAtual > 7) {
			echo "<li><a>...</a></li>";
		}
		for ($i = $PaginaAtual - $Links; $i <= $PaginaAtual - 1; $i++) {
			if ($i <= 0) {
			} else {
				echo "<li><a href=$Link&amp;pagina=$i>$i</a></li>";
			}
		}echo "<li class='active'><a>$PaginaAtual</a></li>";

		for ($i = $PaginaAtual + 1; $i <= $PaginaAtual + $Links; $i++) {
			if ($i > $paginas) {
			} else {
				echo "<li><a href=$Link&amp;pagina=$i>$i</a></li>";
			}
		}
		if ($PaginaAtual + 5 < $paginas) {
			echo "<li>...</li>";
		}
		echo "<li><a href=$Link&amp;pagina=$paginas>&raquo;</a></li>";
	}
?>
 </ul>
		</div>