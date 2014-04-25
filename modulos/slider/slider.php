<div id="myCarousel" class="carousel slide">
	<!-- Carousel items -->
	<div class="carousel-inner">
		<?php
			$Active = 'active';	
			$Tabela = "com_slides";
			$mysql = new conexao;
			$Configuracao = $mysql -> sql_query("SELECT * FROM ".$Tabela." WHERE Status='1' ORDER BY -id");
			while ($GeraConfiguracao = mysql_fetch_object($Configuracao)) {
				$Titulo = $GeraConfiguracao -> Titulo;
				$Link = $GeraConfiguracao -> Link;
				$Imagem = $GeraConfiguracao -> Imagem;
			?>
			<div class="item <?php echo $Active; ?>">
				<?php if(empty($Link)){}else{ ?><a href="<?php echo $Link; ?>"><?php } ?>
					<img src="arquivos/slides/<?php echo $Imagem; ?>" alt="<?php echo $Alt; ?>" title="<?php echo $Titulo; ?>" />
				<?php if(empty($Link)){}else{ ?></a><?php } ?>
			</div>
			<?php 
			$Active = '';	
			}
			?>
			
		
	</div>
	<!-- Carousel nav -->
	<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
		