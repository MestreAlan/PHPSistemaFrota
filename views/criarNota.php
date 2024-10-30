		<div id="logado">
			<div class="gerenciar_localizacao">
				<div class="row">
					<?php
						//include 'views/sideMenu.php';
					?>
					<div id="responsividadeDireita" class="col-xs-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
						<h1>Criar xml da nota provisória</h1>						
						<?php
							include 'php/controllerVisualizadorCriarNota.php';
							
							echo addAddNota();
						?>
					</div>
				</div>
			</div>
		</div>