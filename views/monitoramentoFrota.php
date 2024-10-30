		<div id="logado">
			<div class="monitoramento-frota-page">
				<div class="container">
					<div class="row">
						<?php
							//include 'views/sideMenu.php';
						?>
					
						<div id="responsividadeDireita" class="col-xs-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
							<h1>Monitoramento da frota</h1>
														
								<?php
									include 'php/controllerVisualizadorMonitoramentoFrota.php';
									
									echo 
										'<div id="tabelaMF">
											<table id="tableMonotoramentoFrota" class="table_format_filter MonitorarFrota table table-striped">'.
												listarMonitorarFrota()
											.'</table>
										</div>';
								?>
						</div>
					</div>
				</div>
			</div>
		</div>