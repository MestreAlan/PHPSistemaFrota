						<div class="row">
                            <div class="col-xl-5 col-lg-6">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Clientes</h5>
                                                <h3 class="mt-3 mb-3">12</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> +5.27%</span>
                                                    <span class="text-nowrap">Último mês</span>  
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-sm-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Ordens de serviço</h5>
                                                <h3 class="mt-3 mb-3">5543</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> -1.08%</span>
                                                    <span class="text-nowrap">Último mês</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Receita Bruta</h5>
                                                <h3 class="mt-3 mb-3">R$458.193,00</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> -7.00%</span>
                                                    <span class="text-nowrap">Último mês</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-sm-6">
                                        <div class="card widget-flat">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <i class="mdi mdi-pulse widget-icon"></i>
                                                </div>
                                                <h5 class="text-muted fw-normal mt-0" title="Growth">Gastos totais</h5>
                                                <h3 class="mt-3 mb-3">R$212.352,00</h3>
                                                <p class="mb-0 text-muted">
                                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> +4.87%</span>
                                                    <span class="text-nowrap">Último mês</span>
                                                </p>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row -->

                            </div> <!-- end col -->

                            <div class="col-xl-7 col-lg-6">
                                
								<div id="chart-basic-column"></div>
								
								<script>

									var options = {
										series: [{
											name: '2021',
											data: [67, 71, 90, 92, 80, 87, 80, 100, 101, 115, 100, 95]
										}, {
											name: '2022',
											data: [76, 85, 101, 98, 87, 105, 91, 114, 94, 0, 0, 0]
										}],
										chart: {
											type: 'bar',
											height: 350
										},
										plotOptions: {
											bar: {
												horizontal: false,
												columnWidth: '55%',
												endingShape: 'rounded'
											},
										},
										dataLabels: {
											enabled: false
										},
										stroke: {
											show: true,
											width: 2,
											colors: ['transparent']
										},
										title: {
											text: 'Projeção receita do ano atual vs passado'
										},
										xaxis: {
											categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
										},
										yaxis: {
											title: {
												text: 'R$ (milhares)'
											}
										},
										fill: {
											opacity: 1
										},
										tooltip: {
											y: {
												formatter: function (val) {
													return "R$ " + val + " milhares"
												}
											}
										}
									};

									var chart = new ApexCharts(document.querySelector("#chart-basic-column"), options);
									chart.render();


								</script>

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="header-title">Vendas</h4>
                                            <div class="dropdown">
                                                <a href="https://coderthemes.com/hyper/saas/index.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="chart-content-bg">
                                            <div class="row text-center">
                                                <div class="col-sm-6">
                                                    <p class="text-muted mb-0 mt-3">Semana atual</p>
                                                    <h2 class="fw-normal mb-3">
                                                        <small class="mdi mdi-checkbox-blank-circle text-primary align-middle me-1"></small>
                                                        <span>R$58.254,00</span>
                                                    </h2>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="text-muted mb-0 mt-3">Semana passada</p>
                                                    <h2 class="fw-normal mb-3">
                                                        <small class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                                        <span>R$69.524,00</span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dash-item-overlay d-none d-md-block" dir="ltr">
                                            <h5>Ganhos de hoje: R$2562,30</h5>
                                            <p class="text-muted font-13 mb-3 mt-2">Em verde estão apresentados os ganhos da semana atual</p>
                                            <a href="javascript: void(0);" class="btn btn-outline-primary">Atualizar
                                                <i class="mdi mdi-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                        <div dir="ltr">
                                            <div id="revenue-chart" class="apex-charts mt-3" data-colors="#727cf5,#0acf97" style="min-height: 364px;"><div id="apexchartsoqxipdir" class="apexcharts-canvas apexchartsoqxipdir apexcharts-theme-light" style="width: 751px; height: 364px;"><svg id="SvgjsSvg1293" width="751" height="364" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1295" class="apexcharts-inner apexcharts-graphical" transform="translate(33.78899002075195, 30)"><defs id="SvgjsDefs1294"><clippath id="gridRectMaskoqxipdir"><rect id="SvgjsRect1301" width="713.7297601699829" height="297.11199999999997" x="-4" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clippath><clippath id="forecastMaskoqxipdir"></clippath><clippath id="nonForecastMaskoqxipdir"></clippath><clippath id="gridRectMarkerMaskoqxipdir"><rect id="SvgjsRect1302" width="709.7297601699829" height="297.11199999999997" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clippath><filter id="SvgjsFilter1308" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feflood id="SvgjsFeFlood1309" flood-color="#000000" flood-opacity="0.2" result="SvgjsFeFlood1309Out" in="SourceGraphic"></feflood><fecomposite id="SvgjsFeComposite1310" in="SvgjsFeFlood1309Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1310Out"></fecomposite><feoffset id="SvgjsFeOffset1311" dx="-7" dy="7" result="SvgjsFeOffset1311Out" in="SvgjsFeComposite1310Out"></feoffset><fegaussianblur id="SvgjsFeGaussianBlur1312" stdDeviation="7 " result="SvgjsFeGaussianBlur1312Out" in="SvgjsFeOffset1311Out"></fegaussianblur><femerge id="SvgjsFeMerge1313" result="SvgjsFeMerge1313Out" in="SourceGraphic"><femergenode id="SvgjsFeMergeNode1314" in="SvgjsFeGaussianBlur1312Out"></femergenode><femergenode id="SvgjsFeMergeNode1315" in="[object Arguments]"></femergenode></femerge><feblend id="SvgjsFeBlend1316" in="SourceGraphic" in2="SvgjsFeMerge1313Out" mode="normal" result="SvgjsFeBlend1316Out"></feblend></filter><filter id="SvgjsFilter1321" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feflood id="SvgjsFeFlood1322" flood-color="#000000" flood-opacity="0.2" result="SvgjsFeFlood1322Out" in="SourceGraphic"></feflood><fecomposite id="SvgjsFeComposite1323" in="SvgjsFeFlood1322Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1323Out"></fecomposite><feoffset id="SvgjsFeOffset1324" dx="-7" dy="7" result="SvgjsFeOffset1324Out" in="SvgjsFeComposite1323Out"></feoffset><fegaussianblur id="SvgjsFeGaussianBlur1325" stdDeviation="7 " result="SvgjsFeGaussianBlur1325Out" in="SvgjsFeOffset1324Out"></fegaussianblur><femerge id="SvgjsFeMerge1326" result="SvgjsFeMerge1326Out" in="SourceGraphic"><femergenode id="SvgjsFeMergeNode1327" in="SvgjsFeGaussianBlur1325Out"></femergenode><femergenode id="SvgjsFeMergeNode1328" in="[object Arguments]"></femergenode></femerge><feblend id="SvgjsFeBlend1329" in="SourceGraphic" in2="SvgjsFeMerge1326Out" mode="normal" result="SvgjsFeBlend1329Out"></feblend></filter></defs><line id="SvgjsLine1300" x1="0" y1="0" x2="0" y2="293.11199999999997" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="293.11199999999997" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1330" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1331" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1333" font-family="Helvetica, Arial, sans-serif" x="0" y="322.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1334">Mon</tspan><title>Mon</title></text><text id="SvgjsText1336" font-family="Helvetica, Arial, sans-serif" x="117.62162669499716" y="322.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1337">Tue</tspan><title>Tue</title></text><text id="SvgjsText1339" font-family="Helvetica, Arial, sans-serif" x="235.2432533899943" y="322.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1340">Wed</tspan><title>Wed</title></text><text id="SvgjsText1342" font-family="Helvetica, Arial, sans-serif" x="352.8648800849914" y="322.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1343">Thu</tspan><title>Thu</title></text><text id="SvgjsText1345" font-family="Helvetica, Arial, sans-serif" x="470.4865067799886" y="322.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1346">Fri</tspan><title>Fri</title></text><text id="SvgjsText1348" font-family="Helvetica, Arial, sans-serif" x="588.1081334749858" y="322.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1349">Sat</tspan><title>Sat</title></text><text id="SvgjsText1351" font-family="Helvetica, Arial, sans-serif" x="705.729760169983" y="322.11199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1352">Sun</tspan><title>Sun</title></text></g></g><g id="SvgjsG1365" class="apexcharts-grid"><g id="SvgjsG1366" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1375" x1="0" y1="0" x2="705.7297601699829" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1376" x1="0" y1="73.27799999999999" x2="705.7297601699829" y2="73.27799999999999" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1377" x1="0" y1="146.55599999999998" x2="705.7297601699829" y2="146.55599999999998" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1378" x1="0" y1="219.83399999999997" x2="705.7297601699829" y2="219.83399999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1379" x1="0" y1="293.11199999999997" x2="705.7297601699829" y2="293.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1367" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1368" x1="0" y1="294.11199999999997" x2="0" y2="300.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1369" x1="117.62162669499715" y1="294.11199999999997" x2="117.62162669499715" y2="300.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1370" x1="235.2432533899943" y1="294.11199999999997" x2="235.2432533899943" y2="300.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1371" x1="352.86488008499146" y1="294.11199999999997" x2="352.86488008499146" y2="300.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1372" x1="470.4865067799886" y1="294.11199999999997" x2="470.4865067799886" y2="300.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1373" x1="588.1081334749857" y1="294.11199999999997" x2="588.1081334749857" y2="300.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1374" x1="705.7297601699829" y1="294.11199999999997" x2="705.7297601699829" y2="300.11199999999997" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1381" x1="0" y1="293.11199999999997" x2="705.7297601699829" y2="293.11199999999997" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1380" x1="0" y1="1" x2="0" y2="293.11199999999997" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1303" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG1304" class="apexcharts-series" seriesName="CurrentxWeek" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1307" d="M 0 211.69199999999998C 41.167569343249006 211.69199999999998 76.45405735174816 130.272 117.62162669499716 130.272C 158.78919603824616 130.272 194.07568404674532 170.98199999999997 235.24325338999432 170.98199999999997C 276.4108227332433 170.98199999999997 311.69731074174246 89.56200000000001 352.86488008499146 89.56200000000001C 394.03244942824045 89.56200000000001 429.31893743673965 130.272 470.48650677998864 130.272C 511.65407612323764 130.272 546.9405641317368 48.852000000000004 588.1081334749858 48.852000000000004C 629.2757028182348 48.852000000000004 664.562190826734 130.272 705.7297601699829 130.272" fill="none" fill-opacity="1" stroke="rgba(114,124,245,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskoqxipdir)" filter="url(#SvgjsFilter1308)" pathTo="M 0 211.69199999999998C 41.167569343249006 211.69199999999998 76.45405735174816 130.272 117.62162669499716 130.272C 158.78919603824616 130.272 194.07568404674532 170.98199999999997 235.24325338999432 170.98199999999997C 276.4108227332433 170.98199999999997 311.69731074174246 89.56200000000001 352.86488008499146 89.56200000000001C 394.03244942824045 89.56200000000001 429.31893743673965 130.272 470.48650677998864 130.272C 511.65407612323764 130.272 546.9405641317368 48.852000000000004 588.1081334749858 48.852000000000004C 629.2757028182348 48.852000000000004 664.562190826734 130.272 705.7297601699829 130.272" pathFrom="M -1 293.11199999999997L -1 293.11199999999997L 117.62162669499716 293.11199999999997L 235.24325338999432 293.11199999999997L 352.86488008499146 293.11199999999997L 470.48650677998864 293.11199999999997L 588.1081334749858 293.11199999999997L 705.7297601699829 293.11199999999997"></path><g id="SvgjsG1305" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1387" r="0" cx="0" cy="0" class="apexcharts-marker wi7ui6c3f no-pointer-events" stroke="#ffffff" fill="#727cf5" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1317" class="apexcharts-series" seriesName="PreviousxWeek" data:longestSeries="true" rel="2" data:realIndex="1"><path id="SvgjsPath1320" d="M 0 293.11199999999997C 41.167569343249006 293.11199999999997 76.45405735174816 170.98199999999997 117.62162669499716 170.98199999999997C 158.78919603824616 170.98199999999997 194.07568404674532 211.69199999999998 235.24325338999432 211.69199999999998C 276.4108227332433 211.69199999999998 311.69731074174246 48.852000000000004 352.86488008499146 48.852000000000004C 394.03244942824045 48.852000000000004 429.31893743673965 170.98199999999997 470.48650677998864 170.98199999999997C 511.65407612323764 170.98199999999997 546.9405641317368 8.141999999999996 588.1081334749858 8.141999999999996C 629.2757028182348 8.141999999999996 664.562190826734 89.56200000000001 705.7297601699829 89.56200000000001" fill="none" fill-opacity="1" stroke="rgba(10,207,151,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-line" index="1" clip-path="url(#gridRectMaskoqxipdir)" filter="url(#SvgjsFilter1321)" pathTo="M 0 293.11199999999997C 41.167569343249006 293.11199999999997 76.45405735174816 170.98199999999997 117.62162669499716 170.98199999999997C 158.78919603824616 170.98199999999997 194.07568404674532 211.69199999999998 235.24325338999432 211.69199999999998C 276.4108227332433 211.69199999999998 311.69731074174246 48.852000000000004 352.86488008499146 48.852000000000004C 394.03244942824045 48.852000000000004 429.31893743673965 170.98199999999997 470.48650677998864 170.98199999999997C 511.65407612323764 170.98199999999997 546.9405641317368 8.141999999999996 588.1081334749858 8.141999999999996C 629.2757028182348 8.141999999999996 664.562190826734 89.56200000000001 705.7297601699829 89.56200000000001" pathFrom="M -1 293.11199999999997L -1 293.11199999999997L 117.62162669499716 293.11199999999997L 235.24325338999432 293.11199999999997L 352.86488008499146 293.11199999999997L 470.48650677998864 293.11199999999997L 588.1081334749858 293.11199999999997L 705.7297601699829 293.11199999999997"></path><g id="SvgjsG1318" class="apexcharts-series-markers-wrap" data:realIndex="1"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1388" r="0" cx="0" cy="0" class="apexcharts-marker w1k8wtew1 no-pointer-events" stroke="#ffffff" fill="#0acf97" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1306" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG1319" class="apexcharts-datalabels" data:realIndex="1"></g></g><line id="SvgjsLine1382" x1="0" y1="0" x2="705.7297601699829" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1383" x1="0" y1="0" x2="705.7297601699829" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1384" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1385" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1386" class="apexcharts-point-annotations"></g><rect id="SvgjsRect1389" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect1390" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g><rect id="SvgjsRect1299" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1353" class="apexcharts-yaxis" rel="0" transform="translate(0.7889900207519531, 0)"><g id="SvgjsG1354" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1355" font-family="Helvetica, Arial, sans-serif" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1356">36k</tspan><title>36k</title></text><text id="SvgjsText1357" font-family="Helvetica, Arial, sans-serif" x="20" y="104.678" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1358">27k</tspan><title>27k</title></text><text id="SvgjsText1359" font-family="Helvetica, Arial, sans-serif" x="20" y="177.956" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1360">18k</tspan><title>18k</title></text><text id="SvgjsText1361" font-family="Helvetica, Arial, sans-serif" x="20" y="251.23399999999998" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1362">9k</tspan><title>9k</title></text><text id="SvgjsText1363" font-family="Helvetica, Arial, sans-serif" x="20" y="324.51199999999994" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1364">0k</tspan><title>0k</title></text></g></g><g id="SvgjsG1296" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 182px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(114, 124, 245);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(10, 207, 151);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="header-title">Top Selling Products</h4>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-link">Export <i class="mdi mdi-download ms-1"></i></a>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap table-hover mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">ASOS Ridley High Waist</h5>
                                                            <span class="text-muted font-13">07 April 2018</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$79.49</h5>
                                                            <span class="text-muted font-13">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">82</h5>
                                                            <span class="text-muted font-13">Quantity</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$6,518.18</h5>
                                                            <span class="text-muted font-13">Amount</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">Marco Lightweight Shirt</h5>
                                                            <span class="text-muted font-13">25 March 2018</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$128.50</h5>
                                                            <span class="text-muted font-13">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">37</h5>
                                                            <span class="text-muted font-13">Quantity</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$4,754.50</h5>
                                                            <span class="text-muted font-13">Amount</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">Half Sleeve Shirt</h5>
                                                            <span class="text-muted font-13">17 March 2018</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$39.99</h5>
                                                            <span class="text-muted font-13">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">64</h5>
                                                            <span class="text-muted font-13">Quantity</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$2,559.36</h5>
                                                            <span class="text-muted font-13">Amount</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">Lightweight Jacket</h5>
                                                            <span class="text-muted font-13">12 March 2018</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$20.00</h5>
                                                            <span class="text-muted font-13">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">184</h5>
                                                            <span class="text-muted font-13">Quantity</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$3,680.00</h5>
                                                            <span class="text-muted font-13">Amount</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">Marco Shoes</h5>
                                                            <span class="text-muted font-13">05 March 2018</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$28.49</h5>
                                                            <span class="text-muted font-13">Price</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">69</h5>
                                                            <span class="text-muted font-13">Quantity</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="font-14 my-1 fw-normal">$1,965.81</h5>
                                                            <span class="text-muted font-13">Amount</span>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-3 col-lg-6 order-lg-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="header-title">Total Sales</h4>
                                            <div class="dropdown">
                                                <a href="https://coderthemes.com/hyper/saas/index.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="average-sales" class="apex-charts mb-4 mt-3" data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00" style="min-height: 205.7px;"><div id="apexchartsl1aizhetj" class="apexcharts-canvas apexchartsl1aizhetj apexcharts-theme-light" style="width: 237px; height: 205.7px;"><svg id="SvgjsSvg1514" width="237" height="205.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1516" class="apexcharts-inner apexcharts-graphical" transform="translate(17, 0)"><defs id="SvgjsDefs1515"><clippath id="gridRectMaskl1aizhetj"><rect id="SvgjsRect1518" width="209" height="205" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clippath><clippath id="forecastMaskl1aizhetj"></clippath><clippath id="nonForecastMaskl1aizhetj"></clippath><clippath id="gridRectMarkerMaskl1aizhetj"><rect id="SvgjsRect1519" width="207" height="207" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clippath><filter id="SvgjsFilter1528" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feflood id="SvgjsFeFlood1529" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1529Out" in="SourceGraphic"></feflood><fecomposite id="SvgjsFeComposite1530" in="SvgjsFeFlood1529Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1530Out"></fecomposite><feoffset id="SvgjsFeOffset1531" dx="1" dy="1" result="SvgjsFeOffset1531Out" in="SvgjsFeComposite1530Out"></feoffset><fegaussianblur id="SvgjsFeGaussianBlur1532" stdDeviation="1 " result="SvgjsFeGaussianBlur1532Out" in="SvgjsFeOffset1531Out"></fegaussianblur><femerge id="SvgjsFeMerge1533" result="SvgjsFeMerge1533Out" in="SourceGraphic"><femergenode id="SvgjsFeMergeNode1534" in="SvgjsFeGaussianBlur1532Out"></femergenode><femergenode id="SvgjsFeMergeNode1535" in="[object Arguments]"></femergenode></femerge><feblend id="SvgjsFeBlend1536" in="SourceGraphic" in2="SvgjsFeMerge1533Out" mode="normal" result="SvgjsFeBlend1536Out"></feblend></filter><filter id="SvgjsFilter1541" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feflood id="SvgjsFeFlood1542" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1542Out" in="SourceGraphic"></feflood><fecomposite id="SvgjsFeComposite1543" in="SvgjsFeFlood1542Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1543Out"></fecomposite><feoffset id="SvgjsFeOffset1544" dx="1" dy="1" result="SvgjsFeOffset1544Out" in="SvgjsFeComposite1543Out"></feoffset><fegaussianblur id="SvgjsFeGaussianBlur1545" stdDeviation="1 " result="SvgjsFeGaussianBlur1545Out" in="SvgjsFeOffset1544Out"></fegaussianblur><femerge id="SvgjsFeMerge1546" result="SvgjsFeMerge1546Out" in="SourceGraphic"><femergenode id="SvgjsFeMergeNode1547" in="SvgjsFeGaussianBlur1545Out"></femergenode><femergenode id="SvgjsFeMergeNode1548" in="[object Arguments]"></femergenode></femerge><feblend id="SvgjsFeBlend1549" in="SourceGraphic" in2="SvgjsFeMerge1546Out" mode="normal" result="SvgjsFeBlend1549Out"></feblend></filter><filter id="SvgjsFilter1554" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feflood id="SvgjsFeFlood1555" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1555Out" in="SourceGraphic"></feflood><fecomposite id="SvgjsFeComposite1556" in="SvgjsFeFlood1555Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1556Out"></fecomposite><feoffset id="SvgjsFeOffset1557" dx="1" dy="1" result="SvgjsFeOffset1557Out" in="SvgjsFeComposite1556Out"></feoffset><fegaussianblur id="SvgjsFeGaussianBlur1558" stdDeviation="1 " result="SvgjsFeGaussianBlur1558Out" in="SvgjsFeOffset1557Out"></fegaussianblur><femerge id="SvgjsFeMerge1559" result="SvgjsFeMerge1559Out" in="SourceGraphic"><femergenode id="SvgjsFeMergeNode1560" in="SvgjsFeGaussianBlur1558Out"></femergenode><femergenode id="SvgjsFeMergeNode1561" in="[object Arguments]"></femergenode></femerge><feblend id="SvgjsFeBlend1562" in="SourceGraphic" in2="SvgjsFeMerge1559Out" mode="normal" result="SvgjsFeBlend1562Out"></feblend></filter><filter id="SvgjsFilter1567" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%"><feflood id="SvgjsFeFlood1568" flood-color="#000000" flood-opacity="0.45" result="SvgjsFeFlood1568Out" in="SourceGraphic"></feflood><fecomposite id="SvgjsFeComposite1569" in="SvgjsFeFlood1568Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1569Out"></fecomposite><feoffset id="SvgjsFeOffset1570" dx="1" dy="1" result="SvgjsFeOffset1570Out" in="SvgjsFeComposite1569Out"></feoffset><fegaussianblur id="SvgjsFeGaussianBlur1571" stdDeviation="1 " result="SvgjsFeGaussianBlur1571Out" in="SvgjsFeOffset1570Out"></fegaussianblur><femerge id="SvgjsFeMerge1572" result="SvgjsFeMerge1572Out" in="SourceGraphic"><femergenode id="SvgjsFeMergeNode1573" in="SvgjsFeGaussianBlur1571Out"></femergenode><femergenode id="SvgjsFeMergeNode1574" in="[object Arguments]"></femergenode></femerge><feblend id="SvgjsFeBlend1575" in="SourceGraphic" in2="SvgjsFeMerge1572Out" mode="normal" result="SvgjsFeBlend1575Out"></feblend></filter></defs><g id="SvgjsG1520" class="apexcharts-pie"><g id="SvgjsG1521" transform="translate(0, 0) scale(1)"><circle id="SvgjsCircle1522" r="60.46585365853659" cx="101.5" cy="101.5" fill="transparent"></circle><g id="SvgjsG1523" class="apexcharts-slices"><g id="SvgjsG1524" class="apexcharts-series apexcharts-pie-series" seriesName="Direct" rel="1" data:realIndex="0"><path id="SvgjsPath1525" d="M 101.5 8.475609756097555 A 93.02439024390245 93.02439024390245 0 0 1 192.8486516764292 119.07728696779631 L 160.87662358967896 112.9252365290676 A 60.46585365853659 60.46585365853659 0 0 0 101.5 41.03414634146341 L 101.5 8.475609756097555 z" fill="rgba(114,124,245,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="100.89171974522293" data:startAngle="0" data:strokeWidth="2" data:value="44" data:pathOrig="M 101.5 8.475609756097555 A 93.02439024390245 93.02439024390245 0 0 1 192.8486516764292 119.07728696779631 L 160.87662358967896 112.9252365290676 A 60.46585365853659 60.46585365853659 0 0 0 101.5 41.03414634146341 L 101.5 8.475609756097555 z" stroke="transparent"></path></g><g id="SvgjsG1537" class="apexcharts-series apexcharts-pie-series" seriesName="Affilliate" rel="2" data:realIndex="1"><path id="SvgjsPath1538" d="M 192.8486516764292 119.07728696779631 A 93.02439024390245 93.02439024390245 0 0 1 33.45921553459769 164.93491806239305 L 57.2734900974885 142.73269674055547 A 60.46585365853659 60.46585365853659 0 0 0 160.87662358967896 112.9252365290676 L 192.8486516764292 119.07728696779631 z" fill="rgba(10,207,151,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="126.11464968152865" data:startAngle="100.89171974522293" data:strokeWidth="2" data:value="55" data:pathOrig="M 192.8486516764292 119.07728696779631 A 93.02439024390245 93.02439024390245 0 0 1 33.45921553459769 164.93491806239305 L 57.2734900974885 142.73269674055547 A 60.46585365853659 60.46585365853659 0 0 0 160.87662358967896 112.9252365290676 L 192.8486516764292 119.07728696779631 z" stroke="transparent"></path></g><g id="SvgjsG1550" class="apexcharts-series apexcharts-pie-series" seriesName="Sponsored" rel="3" data:realIndex="2"><path id="SvgjsPath1551" d="M 33.45921553459769 164.93491806239305 A 93.02439024390245 93.02439024390245 0 0 1 42.981967675570004 29.186950879341154 L 63.463278989120504 54.49651807157175 A 60.46585365853659 60.46585365853659 0 0 0 57.2734900974885 142.73269674055547 L 33.45921553459769 164.93491806239305 z" fill="rgba(250,92,124,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="94.01273885350315" data:startAngle="227.00636942675158" data:strokeWidth="2" data:value="41" data:pathOrig="M 33.45921553459769 164.93491806239305 A 93.02439024390245 93.02439024390245 0 0 1 42.981967675570004 29.186950879341154 L 63.463278989120504 54.49651807157175 A 60.46585365853659 60.46585365853659 0 0 0 57.2734900974885 142.73269674055547 L 33.45921553459769 164.93491806239305 z" stroke="transparent"></path></g><g id="SvgjsG1563" class="apexcharts-series apexcharts-pie-series" seriesName="Exmail" rel="4" data:realIndex="3"><path id="SvgjsPath1564" d="M 42.981967675570004 29.186950879341154 A 93.02439024390245 93.02439024390245 0 0 1 101.48376418113826 8.475611172940035 L 101.48944671773987 41.034147262411025 A 60.46585365853659 60.46585365853659 0 0 0 63.463278989120504 54.49651807157175 L 42.981967675570004 29.186950879341154 z" fill="rgba(255,188,0,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="38.980891719745216" data:startAngle="321.0191082802547" data:strokeWidth="2" data:value="17" data:pathOrig="M 42.981967675570004 29.186950879341154 A 93.02439024390245 93.02439024390245 0 0 1 101.48376418113826 8.475611172940035 L 101.48944671773987 41.034147262411025 A 60.46585365853659 60.46585365853659 0 0 0 63.463278989120504 54.49651807157175 L 42.981967675570004 29.186950879341154 z" stroke="transparent"></path></g><g id="SvgjsG1526" class="apexcharts-datalabels"><text id="SvgjsText1527" font-family="Helvetica, Arial, sans-serif" x="160.67226903135253" y="52.62816433784388" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1528)" style="font-family: Helvetica, Arial, sans-serif;">28.0%</text></g><g id="SvgjsG1539" class="apexcharts-datalabels"><text id="SvgjsText1540" font-family="Helvetica, Arial, sans-serif" x="122.71942261396973" y="175.25330397505797" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1541)" style="font-family: Helvetica, Arial, sans-serif;">35.0%</text></g><g id="SvgjsG1552" class="apexcharts-datalabels"><text id="SvgjsText1553" font-family="Helvetica, Arial, sans-serif" x="24.943017464100137" y="96.12950949116579" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1554)" style="font-family: Helvetica, Arial, sans-serif;">26.1%</text></g><g id="SvgjsG1565" class="apexcharts-datalabels"><text id="SvgjsText1566" font-family="Helvetica, Arial, sans-serif" x="75.89401554100846" y="29.15259297532883" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#ffffff" class="apexcharts-text apexcharts-pie-label" filter="url(#SvgjsFilter1567)" style="font-family: Helvetica, Arial, sans-serif;">10.8%</text></g></g></g></g><line id="SvgjsLine1576" x1="0" y1="0" x2="203" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1577" x1="0" y1="0" x2="203" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1517" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(114, 124, 245);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(10, 207, 151);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(250, 92, 124);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 4;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 188, 0);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                       

                                        <div class="chart-widget-list">
                                            <p>
                                                <i class="mdi mdi-square text-primary"></i> Direct
                                                <span class="float-end">$300.56</span>
                                            </p>
                                            <p>
                                                <i class="mdi mdi-square text-danger"></i> Affilliate
                                                <span class="float-end">$135.18</span>
                                            </p>
                                            <p>
                                                <i class="mdi mdi-square text-success"></i> Sponsored
                                                <span class="float-end">$48.96</span>
                                            </p>
                                            <p class="mb-0">
                                                <i class="mdi mdi-square text-warning"></i> E-mail
                                                <span class="float-end">$154.02</span>
                                            </p>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-xl-3 col-lg-6 order-lg-1">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="header-title">Recent Activity</h4>
                                            <div class="dropdown">
                                                <a href="https://coderthemes.com/hyper/saas/index.html#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body py-0" data-simplebar="init" style="max-height: 405px;"><div class="simplebar-wrapper" style="margin: 0px -24px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 24px;"> 
                                        <div class="timeline-alt py-0">
                                            <div class="timeline-item">
                                                <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">You sold an item</a>
                                                    <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">5 minutes ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Product on the Bootstrap Market</a>
                                                    <small>Dave Gamache added
                                                        <span class="fw-bold">Admin Dashboard</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">30 minutes ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">Robert Delaney</a>
                                                    <small>Send you message
                                                        <span class="fw-bold">"Are you there?"</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">2 hours ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Audrey Tobey</a>
                                                    <small>Uploaded a photo
                                                        <span class="fw-bold">"Error.jpg"</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">14 hours ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">You sold an item</a>
                                                    <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">16 hours ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Product on the Bootstrap Market</a>
                                                    <small>Dave Gamache added
                                                        <span class="fw-bold">Admin Dashboard</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">22 hours ago</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">Robert Delaney</a>
                                                    <small>Send you message
                                                        <span class="fw-bold">"Are you there?"</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">2 days ago</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end timeline -->
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 709px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 231px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> <!-- end slimscroll -->
                                </div>
                                <!-- end card-->
                            </div>
                            <!-- end col -->

                        </div>
                        <!-- end row -->
	