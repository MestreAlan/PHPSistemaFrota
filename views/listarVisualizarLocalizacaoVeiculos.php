		<div id="logado">
			<div class="person-page">
				<div class="container">
					<div class="row">
						<?php
							//include 'views/sideMenu.php';
						?>
						
						<div class="modal modalSpinner fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
							<div class="modal-dialog modal-sm">
								<div class="modal-content" style="width: 48px">
									<span class="fa fa-spinner fa-spin fa-3x"></span>
								</div>
							</div>
						</div>
						
						<div id="responsividadeDireita" class="col-xs-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
							<h1>Localizações</h1>
							<?php
								
								include 'php/controllerVisualizarLocalizacaoVeiculos.php';
								
								echo listarVeiculosLocalizacao();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
