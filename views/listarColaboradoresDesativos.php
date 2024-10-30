		<div id="logado">
			<div class="person-page">
				<div class="container">
					<div class="row">
						<?php
							//include 'views/sideMenu.php';
						?>
						<div id="responsividadeDireita" class="col-xs-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
							<h1>Lista de colaboradores desativos</h1>
							<?php
								
								include 'php/controllerVisualizadorColaboradoresDesativos.php';
								
								echo chamarListarDocumentos();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
