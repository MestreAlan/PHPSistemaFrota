		<div id="logado">
			<div class="gerenciar_localizacao">
				<div class="container">
					<div class="row">
						<?php
							//include 'views/sideMenu.php';
						?>
						<div id="responsividadeDireita" class="col-xs-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
							<h1>Gerenciar localizações</h1>						
							<?php
								include 'php/controllerVisualizadorGerenciarLocalizacoes.php';
								
								echo addLocalizacao();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>