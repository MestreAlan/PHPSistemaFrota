		<div id="logado">
			<div class="monitoramento-frota-page">
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
						<h1>Precificação das rotas</h1>
													
							<?php
								include 'php/controllerVisualizadorPrecificarRota.php';
								
								echo addPrecificacao();
								
								echo listarPrecificacoes();
							?>
					</div>
				</div>
			</div>
		</div>