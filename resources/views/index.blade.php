@extends('layouts.default')

@section('title', 'Registro de Niños/Niñas')

@push('css')
    <link href="assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" /> 
	<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush
@section('content')
			
	<!-- begin page-header -->
	<h1 class="page-header">Registrar Niño/Niña <small>Registro del niño/niña y tutor</small></h1>
	<!-- end page-header -->
	<!-- begin wizard-form -->
	<form action="{{ route('registrar.persona') }}" method="POST" name="form-wizard" id="registrar" class="form-control-with-bg">
		@csrf
		<!-- begin wizard -->
		<div id="wizard">
			<!-- begin wizard-step -->
			<ul>
				<li>
					<a href="#step-1">
						<span class="number">1</span> 
						<span class="info">
							Datos del Niño/Niña
							<small>Ingrese los datos correspondientes</small>
						</span>
					</a>
				</li>
				<li>
					<a href="#step-2">
						<span class="number">2</span> 
						<span class="info">
							Datos del Padre
							<small>Ingrese los datos correspondientes</small>
						</span>
					</a>
				</li>
			</ul>
			<!-- end wizard-step -->
			<!-- begin wizard-content -->
			<div>
				<!-- begin step-1 -->
				<div id="step-1">
					<!-- begin fieldset -->
					<fieldset>
						<!-- begin row -->
						<div class="row">
							<!-- begin col-8 -->
							<div class="col-xl-8 offset-xl-2">
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Información del Niño/Niña</legend>
								<!-- begin form-group -->
								<div class="form-group row m-b-12">
									<p class="mb-2">C.I. <span class="text-danger">*</span></p>
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<input type="text" id="ci" name="ci" placeholder="INGRESE LA CÉDULA DE IDENTIDAD" data-parsley-group="step-1" minlength="2" maxlength="15" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_ci(event)"/>
										</div>
									</div>
								</div>
								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-4">
												<p class="mb-2">Nombres <span class="text-danger">*</span></p>
												<input type="text" id="nombre" name="nombre" placeholder="INGRESE LOS NOMBRES" data-parsley-group="step-1" data-parsley-required="true" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
											</div>
											<div class="col-4">
												<p class="mb-2">Apellido Paterno <span class="text-danger">*</span></p>
												<input type="text" id="ape_pat" name="ape_pat" placeholder="INGRESE EL APELLIDO PATERNO" data-parsley-group="step-1" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
											</div>
											<div class="col-4">
												<p class="mb-2">Apellido Materno <span class="text-danger">*</span></p>
												<input type="text" id="ape_mat" name="ape_mat" placeholder="INGRESE EL APELLIDO MATERNO" data-parsley-group="step-1" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-6">
												<p class="mb-2">Fecha de Nacimiento <span class="text-danger">*</span></p>
												<div class="input-group date" id="datepicker-disabled-past2" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
													<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fecha" name="fecha" data-parsley-group="step-1" required/>
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												</div>
											</div>
											<div class="col-6">
												<p class="mb-2">Género <span class="text-danger">*</span></p>
												<select id="gen" name="gen" data-parsley-group="step-1" class="default-select2 form-control" data-live-search="true" required>
													<option value="" disabled selected>Seleccione Género</option>
													<option value="F">FEMENINO</option>
													<option value="M">MASCULINO</option>
												</select>
											</div>
										</div>
									</div>
								</div>
																
							</div>
							<!-- end col-8 -->
						</div>
						<!-- end row -->
					</fieldset>
					<!-- end fieldset -->
				</div>
				<!-- end step-1 -->
				<!-- begin step-2 -->
				<div id="step-2">
					<fieldset>
						<!-- begin row -->
						<div class="row">
							<!-- begin col-8 -->
							<div class="col-xl-8 offset-xl-2">
								<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Información del Padre</legend>
								<!-- begin form-group -->
								
								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-8">
												<p class="mb-2">C.I. <span class="text-danger">*</span></p>
												<input type="text" id="cip" name="cip" placeholder="INGRESE LA CÉDULA DE IDENTIDAD" data-parsley-group="step-2" minlength="2" maxlength="15" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_ci(event)" required/>
											</div>
											<div class="col-4">
												<p class="mb-2">&nbsp;&nbsp;</p>
												<a onclick="buscar()" type="submit" class="btn btn-info" style="width: 200px; color:white">Buscar</a>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row m-b-12">
									
									<div class="col-lg-9 col-xl-12">
										<p class="mb-2">Parentesco <span class="text-danger">*</span></p>
										<select id="paren" name="paren" data-parsley-group="step-2" class="default-select2 form-control" data-size="10" data-live-search="true" required>
											
										</select>
									</div>
								</div>
								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-4">
												<p class="mb-2">Nombres <span class="text-danger">*</span></p>
												<input type="text" id="nombrep" name="nombrep" placeholder="INGRESE LOS NOMBRES" data-parsley-group="step-2" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)" required/>
											</div>
											<div class="col-4">
												<p class="mb-2">Apellido Paterno <span class="text-danger">*</span></p>
												<input type="text" id="ape_patp" name="ape_patp" placeholder="INGRESE EL APELLIDO PATERNO" data-parsley-group="step-2" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
											</div>
											<div class="col-4">
												<p class="mb-2">Apellido Materno <span class="text-danger">*</span></p>
												<input type="text" id="ape_matp" name="ape_matp" placeholder="INGRESE EL APELLIDO MATERNO" data-parsley-group="step-2" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-6">
												<p class="mb-2">Fecha de Nacimiento <span class="text-danger">*</span></p>
												<div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
													<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechap" name="fechap" data-parsley-group="step-2" required/>
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												</div>
											</div>
											<div class="col-6">
												<p class="mb-2">Género <span class="text-danger">*</span></p>
												<select id="genp" name="genp" data-parsley-group="step-2" class="default-select2 form-control" data-live-search="true" required>
													<option value="" disabled selected>Seleccione Género</option>
													<option value="F">FEMENINO</option>
													<option value="M">MASCULINO</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-6">
												<p class="mb-2">Domicilio <span class="text-danger">*</span></p>
												<input type="text" id="domp" name="domp" placeholder="INGRESE EL DOMICILIO ACTUAL" data-parsley-group="step-2" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_domicilio(event)" required/>
											</div>
											<div class="col-6">
												<p class="mb-2">Ocupación <span class="text-danger">*</span></p>
												<select id="ocup" name="ocup" data-parsley-group="step-2" class="default-select2 form-control" data-size="10" data-live-search="true" required>
													
												</select><br>
												<a href="#modal-without-animation2" data-toggle="modal" type="submit" class="btn btn-success" style="width: 150px; color:white; height:30px">Agregar Ocupación</a>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-6">
												<p class="mb-2">Teléfono Personal <span class="text-danger">*</span></p>
												<input minlength="5" maxlength="13" onkeypress="return solo_numeros(event)" type="text" name="tel_persp" value="" id="tel_persp" placeholder="INGRESE NÚMERO DE TELÉFONO" data-parsley-group="step-2" class="form-control" required/>
											</div>
											<div class="col-6">
												<p class="mb-2">Teléfono Fijo <span class="text-danger">*</span></p>
												<input minlength="5" maxlength="13" onkeypress="return solo_numeros(event)" type="text" name="telp" value="" id="telp" placeholder="INGRESE NÚMERO DE TELÉFONO FIJO" data-parsley-group="step-2" class="form-control"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="text-center">
									<button class="btn btn-primary btn-lg" type="submit" onclick="control()">Registrar Datos</button>
								</div>
								<br>
								<div>
									<a href="" class="btn btn-success" style="color: white">Registrar Nuevo Niño/Niña</a>
								</div>
							</div>
							<!-- end col-8 -->
						</div>
						<!-- end row -->
					</fieldset>
				</div>
				<!-- end step-2 -->
				
			</div>
			<!-- end wizard-content -->
		</div>
		<!-- end wizard -->
	</form>
	<!-- end wizard-form -->

	

	<div class="col-xl-12">

		<div class="panel panel-info">
			
			<div class="panel-heading">
				<h4 class="panel-title">LISTA DE NIÑOS REGISTRADOS</h4>
			</div>
			
			
			<div class="panel-body">
				<div class="table-responsive">
					<table id="lista" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">Nº</th>
								<th class="text-nowrap">CI</th>
								<th class="text-nowrap">NOMBRE COMPLETO</th>
								<th class="text-nowrap">FECHA DE NACIMIENTO</th>
								<th class="text-nowrap">EDAD</th>
								<th class="text-nowrap">GÉNERO</th>
								<th class="text-nowrap" data-orderable="false"> &nbsp; &nbsp; ACCIONES &nbsp; &nbsp;</th>
							</tr>
						</thead>
						<tbody>
	
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
		
	</div>

	<div class="modal" id="modal-without-animation" role="dialog" style="overflow-y: scroll"> 
		<div class="modal-dialog" style="max-width: 40% !important;">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Seleccione uno para su edición</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div id="dibujar">
						
					</div>
					
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-dialog" role="dialog" style="overflow-y: scroll">
        <div class="modal-dialog" style="max-width: 50% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar datos del Niño/Niña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        <form action="{{ route('actualizar.datos.ben')}}" id="enviara" method="POST" name="" class="form-control-with-bg">
                            @csrf
							<input type="hidden" name="ben" id="ben" value="">
                            <div class="panel-body">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Información del Niño/Niña</legend>
								<!-- begin form-group -->
								<div class="form-group row m-b-12">
									<p class="mb-2">C.I. <span class="text-danger">*</span></p>
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<input type="text" id="cie" name="cie" placeholder="INGRESE LA CÉDULA DE IDENTIDAD" minlength="2" maxlength="15" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_ci(event)"/>
										</div>
									</div>
								</div>
								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-4">
												<p class="mb-2">Nombres <span class="text-danger">*</span></p>
												<input type="text" id="nombree" name="nombree" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE LOS NOMBRES" data-parsley-required="true" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
											</div>
											<div class="col-4">
												<p class="mb-2">Apellido Paterno <span class="text-danger">*</span></p>
												<input type="text" id="ape_pate" name="ape_pate" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE EL APELLIDO PATERNO" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
											</div>
											<div class="col-4">
												<p class="mb-2">Apellido Materno <span class="text-danger">*</span></p>
												<input type="text" id="ape_mate" name="ape_mate" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE EL APELLIDO MATERNO" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row m-b-12">
									<div class="col-lg-9 col-xl-12">
										<div class="row row-space-6">
											<div class="col-6">
												<p class="mb-2">Fecha de Nacimiento <span class="text-danger">*</span></p>
												<div class="input-group date" id="datepicker-disabled-past3" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
													<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechae" name="fechae" required/>
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												</div>
											</div>
											<div class="col-6">
												<p class="mb-2">Género <span class="text-danger">*</span></p>
												<select id="gene" name="gene" class="default-select2 form-control" data-live-search="true" required>
													<option value="" disabled selected>Seleccione Género</option>
													<option value="F">FEMENINO</option>
													<option value="M">MASCULINO</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="text-center">
									<button class="btn btn-primary btn-lg" type="submit" onclick="control2()">Actualizar Datos</button>
								</div>
                            </div>
                            
                        </form>
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="modal-dialog2" role="dialog" style="overflow-y: scroll">
        <div class="modal-dialog" style="max-width: 50% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar datos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        <form action="{{ route('actualizar.datos.persona') }}" id="enviarb" method="POST" name="" class="form-control-with-bg">
                            @csrf
							<input type="hidden" name="tutor" id="tutor" value="">
                            <div class="panel-body">
								<!-- begin col-8 -->
								<div class="col-xl-8 offset-xl-2">
									<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Información Correspondiente</legend>
									<!-- begin form-group -->
									
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<p class="mb-2">C.I. <span class="text-danger">*</span></p>
											<input type="text" id="cipe" name="cipe" placeholder="INGRESE LA CÉDULA DE IDENTIDAD" minlength="2" maxlength="15" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_ci(event)" required/>
										</div>
									</div>
									
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<div class="row row-space-6">
												<div class="col-4">
													<p class="mb-2">Nombres <span class="text-danger">*</span></p>
													<input type="text" id="nombrepe" name="nombrepe" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE LOS NOMBRES" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)" required/>
												</div>
												<div class="col-4">
													<p class="mb-2">Apellido Paterno <span class="text-danger">*</span></p>
													<input type="text" id="ape_patpe" name="ape_patpe" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE EL APELLIDO PATERNO" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
												</div>
												<div class="col-4">
													<p class="mb-2">Apellido Materno <span class="text-danger">*</span></p>
													<input type="text" id="ape_matpe" name="ape_matpe" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE EL APELLIDO MATERNO" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
												</div>
											</div>
										</div>
									</div>
	
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<div class="row row-space-6">
												<div class="col-6">
													<p class="mb-2">Fecha de Nacimiento <span class="text-danger">*</span></p>
													<div class="input-group date" id="datepicker-disabled-past4" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
														<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechape" name="fechape" required/>
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
												</div>
												<div class="col-6">
													<p class="mb-2">Género <span class="text-danger">*</span></p>
													<select id="genpe" name="genpe" class="default-select2 form-control" data-live-search="true" required>
														<option value="" disabled selected>Seleccione Género</option>
														<option value="F">FEMENINO</option>
														<option value="M">MASCULINO</option>
													</select>
												</div>
											</div>
										</div>
									</div>
	
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<div class="row row-space-6">
												<div class="col-6">
													<p class="mb-2">Domicilio <span class="text-danger">*</span></p>
													<input type="text" id="dompe" name="dompe" pattern="^[A-Za-z]([A-Za-z]|[0-9]|/\.| )*[A-Za-z]" placeholder="INGRESE EL DOMICILIO ACTUAL" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_domicilio(event)" required/>
												</div>
												<div class="col-6">
													<p class="mb-2">Ocupación <span class="text-danger">*</span></p>
													<select id="ocupe" name="ocupe" class="default-select2 form-control" data-size="10" data-live-search="true" required>
														
													</select><br>
													<a href="#modal-without-animation2" data-toggle="modal" type="submit" class="btn btn-success" style="width: 150px; color:white; height:30px">Agregar Ocupación</a>
												</div>
											</div>
										</div>
									</div>
	
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<div class="row row-space-6">
												<div class="col-6">
													<p class="mb-2">Teléfono Personal <span class="text-danger">*</span></p>
													<input minlength="5" maxlength="13" onkeypress="return solo_numeros(event)" type="text" name="tel_perspe" value="" id="tel_perspe" placeholder="INGRESE NÚMERO DE TELÉFONO" class="form-control" required/>
												</div>
												<div class="col-6">
													<p class="mb-2">Teléfono Fijo <span class="text-danger">*</span></p>
													<input minlength="5" maxlength="13" onkeypress="return solo_numeros(event)" type="text" name="telpe" value="" id="telpe" placeholder="INGRESE NÚMERO DE TELÉFONO FIJO" class="form-control"/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="text-center">
										<button class="btn btn-primary btn-lg" type="submit" onclick="control3()">Actualizar Datos</button>
									</div>
								</div>
								<!-- end col-8 -->
                                
                            </div>
                            
                        </form>
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="modal-dialog3" role="dialog" style="overflow-y: scroll">
        <div class="modal-dialog" style="max-width: 50% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Responsable</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        <form action="{{ route('agregar.persona') }}" id="enviarc" method="POST" name="" class="form-control-with-bg">
                            @csrf
							<input type="hidden" name="ben2" id="ben2" value="">
                            <div class="panel-body">
								<!-- begin col-8 -->
								<div class="col-xl-8 offset-xl-2">
									<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Información Correspondiente</legend>
									<!-- begin form-group -->
									<div class="form-group row m-b-12">
										<div class="form-group row m-b-12">
											<div class="col-8">
												<p class="mb-2">C.I. <span class="text-danger">*</span></p>
												<input type="text" id="cipa" name="cipa" placeholder="INGRESE LA CÉDULA DE IDENTIDAD" minlength="2" maxlength="15" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_ci(event)" required/>
											</div>
											<div class="col-4">
												<p class="mb-2">&nbsp;&nbsp;</p>
												<a onclick="buscar2()" type="submit" class="btn btn-info" style="width: 150px; color:white">Buscar</a>
											</div>
										</div>
										<div class="col-lg-9 col-xl-12">
											<p class="mb-2">Parentesco <span class="text-danger">*</span></p>
											<select id="parena" name="parena" class="default-select2 form-control" onchange="valor(this)" data-size="10" data-live-search="true" required>
												
											</select>
										</div>
									</div>
									
									
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<div class="row row-space-6">
												<div class="col-4">
													<p class="mb-2">Nombres <span class="text-danger">*</span></p>
													<input type="text" id="nombrepa" name="nombrepa" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE LOS NOMBRES" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)" required/>
												</div>
												<div class="col-4">
													<p class="mb-2">Apellido Paterno <span class="text-danger">*</span></p>
													<input type="text" id="ape_patpa" name="ape_patpa" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE EL APELLIDO PATERNO" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
												</div>
												<div class="col-4">
													<p class="mb-2">Apellido Materno <span class="text-danger">*</span></p>
													<input type="text" id="ape_matpa" name="ape_matpa" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE EL APELLIDO MATERNO" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)"/>
												</div>
											</div>
										</div>
									</div>
	
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<div class="row row-space-6">
												<div class="col-6">
													<p class="mb-2">Fecha de Nacimiento <span class="text-danger">*</span></p>
													<div class="input-group date" id="datepicker-disabled-past5" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
														<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechapa" name="fechapa" required/>
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
												</div>
												<div class="col-6">
													<p class="mb-2">Género <span class="text-danger">*</span></p>
													<select id="genpa" name="genpa" class="default-select2 form-control" data-live-search="true" required>
														<option value="" disabled selected>Seleccione Género</option>
														<option value="F">FEMENINO</option>
														<option value="M">MASCULINO</option>
													</select>
												</div>
											</div>
										</div>
									</div>
	
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<div class="row row-space-6">
												<div class="col-6">
													<p class="mb-2">Domicilio <span class="text-danger">*</span></p>
													<input type="text" id="dompa" name="dompa" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE EL DOMICILIO ACTUAL" class="form-control" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_domicilio(event)" required/>
												</div>
												<div class="col-6">
													<p class="mb-2">Ocupación <span class="text-danger">*</span></p>
													<select id="ocupa" name="ocupa" class="default-select2 form-control" data-size="10" data-live-search="true" required>
														
													</select><br>
													<a href="#modal-without-animation2" data-toggle="modal" type="submit" class="btn btn-success" style="width: 150px; color:white; height:30px">Agregar Ocupación</a>
												</div>
											</div>
										</div>
									</div>
	
									<div class="form-group row m-b-12">
										<div class="col-lg-9 col-xl-12">
											<div class="row row-space-6">
												<div class="col-6">
													<p class="mb-2">Teléfono Personal <span class="text-danger">*</span></p>
													<input minlength="5" maxlength="13" onkeypress="return solo_numeros(event)" type="text" name="tel_perspa" value="" id="tel_perspa" placeholder="INGRESE NÚMERO DE TELÉFONO" class="form-control" required/>
												</div>
												<div class="col-6">
													<p class="mb-2">Teléfono Fijo <span class="text-danger">*</span></p>
													<input minlength="5" maxlength="13" onkeypress="return solo_numeros(event)" type="text" name="telpa" value="" id="telpa" placeholder="INGRESE NÚMERO DE TELÉFONO FIJO" class="form-control"/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="text-center">
										<button class="btn btn-primary btn-lg" type="submit" onclick="control4()">Agregar Responsable</button>
									</div>
								</div>
								<!-- end col-8 -->
                                
                            </div>
                            
                        </form>
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

	<div class="modal" id="modal-without-animation2" role="dialog" style="overflow-y: scroll"> 
		<div class="modal-dialog" style="max-width: 40% !important;">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Agregar Ocupación</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" action="{{ route('agregar.ocupacion') }}" method="POST" id="registraro">
						@csrf
						<div class="form-group row m-b-15">
							<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Ocupación * :</label>
							<div class="col-md-8 col-sm-8">
								<input class="form-control" type="text" id="fullname" name="fullname" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE LA OCUPACION" data-parsley-required="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_ci(event)" />
							</div>
						</div>
						
						<div class="form-group row m-b-0">
							<label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
							<div class="col-md-8 col-sm-8">
								<button type="submit" class="btn btn-primary">Registrar Ocupación</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cerrar</a>
				</div>
			</div>
		</div>
	</div>

	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
@endsection

@push('scripts')

<script>
	function obtener(dato){
		$('#dibujar').empty();
		$.ajax({
			type:'POST',
			url:"{{ route('obtener.tutores') }}",
			data:{ _token: '{{ csrf_token ()}}', id:dato},
			success:function(htm){
				html = '<button type="submit" href="#modal-dialog" class="btn btn-sm btn-info" data-toggle="modal" onclick="editar_nino('+htm[0]+')")>EDITAR DATOS DEL NIÑO/NIÑA</button>&nbsp;<br><br>';
				for (let i = 2; i < htm.length; i=i+3) {
					html += '<button type="submit" href="#modal-dialog2" class="btn btn-sm btn-info" data-toggle="modal" onclick="editar_parentesco('+htm[i-1]+')">EDITAR DATOS DEL '+htm[i]+'</button>&nbsp;<br><br>';
				}
				html += '<button type="submit" href="#modal-dialog3" class="btn btn-sm btn-success" data-toggle="modal" style="float: right" onclick="agregar_responsable('+htm[0]+')")>Agregar Responsable</button>&nbsp;';
				$('#dibujar').append(html);
			}
			
		});
	}
</script>

<script>
	function editar_parentesco(dato){
		$.ajax({
			type:'POST',
			url:"{{ route('buscar.datos.persona') }}",
			data:{ _token: '{{ csrf_token ()}}', id:dato},
			success:function(html){
				$('#tutor').val(dato);
				$('#cipe').val(html[4]);
				$('#ape_patpe').val(html[1]);
				$('#ape_matpe').val(html[2]);
				$('#nombrepe').val(html[3]);
				$('#fechape').val(html[5]);
				$('#tel_perspe').val(html[11]);
				$('#telpe').val(html[8]);
				htm = "";
				if(html[6] == "M"){
					htm += '<option value="M">MASCULINO</option><option value="F">FEMENINO</option>'
				}
				else if(html[6] == "F"){
					htm += '<option value="F">FEMENINO</option><option value="M">MASCULINO</option>'
				}
				$('#genpe').html(htm);

				$.ajax({
					type:'POST',
					url:"{{ route('mostrar.ocupacion') }}",
					data:{ _token: '{{ csrf_token ()}}', id:html[9]},
					success:function(htm){
						$('#ocupe').html(htm);
					}
					
				});
				$('#dompe').val(html[7]);
			}
			
		});
	}

	function editar_nino(dato){
		$.ajax({
			type:'POST',
			url:"{{ route('buscar.datos.persona') }}",
			data:{ _token: '{{ csrf_token ()}}', id:dato},
			success:function(html){
				$('#ben').val(dato);
				$('#cie').val(html[4]);
				$('#ape_pate').val(html[1]);
				$('#ape_mate').val(html[2]);
				$('#nombree').val(html[3]);
				$('#fechae').val(html[5]);
				htm = "";
				if(html[6] == "M"){
					htm += '<option value="M">MASCULINO</option><option value="F">FEMENINO</option>'
				}
				else if(html[6] == "F"){
					htm += '<option value="F">FEMENINO</option><option value="M">MASCULINO</option>'
				}
				$('#gene').html(htm);
			}
			
		});
	}

	function agregar_responsable(dato){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.parentesco') }}',
			success:function(html){
				$('#parena').html(html);
			}
			
		});

		$.ajax({
			type:'GET',
			url:'{{ route('listar.ocupacion') }}',
			success:function(html){
				$('#ocupa').html(html);
			}
			
		});

		$('#ben2').val(dato);
	}
</script>

<script>
    $(document).ready( function () {
        $('#lista').DataTable({
            "ajax": {
                url: "{{route('ver.lista.ninos')}}",
                type: 'GET'
            },
            columns: [
                        {data:'numero'  , name: 'numero'}, 
                        {data: 'ci' , name: 'ci'}, 
                        {data: 'nombres' , name: 'nombres'},
                        {data: 'fecha_nac' , name: 'fecha_nac'},
                        {data: 'edad' , name: 'edad'},
                        {data: 'sexo' , name: 'sexo'},
                        {data: 'boton', name: 'boton'}
            ],
            error: function(jqXHR, textStatus, errorThrown){
                $("#lista").DataTable().clear().draw();
            },
            dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            language: {
                "url": "{{asset('assets')}}/plugins/datatables.net/spanish.json"
            },
            responsive: false,
            serverSide: false,
            processing: true,
            buttons: [
            { extend: 'copy', text: 'Copiar', className: 'btn-sm' },
            { extend: 'csv', className: 'btn-sm' },
            { extend: 'pdf', className: 'btn-sm' },
            { extend: 'print', text: 'Imprimir', className: 'btn-sm' }
            ],
            columnDefs: [
            { orderable: false, targets: 6 }
            ],
        });
        
    });
</script>

<script>
	var $select =$("#paren").change(function(){
		var e = $(this).val();
		var text = $select.find('option[value=' + e +']').text();
		htm = "";
		if(text == "MADRE"){
			htm += '<option value="F">FEMENINO</option><option value="M">MASCULINO</option>';
		}
		else if(text == "PADRE"){
			htm += '<option value="M">MASCULINO</option><option value="F">FEMENINO</option>';
		}
		else htm += '<option value="" disabled selected>Seleccione Género</option><option value="F">FEMENINO</option><option value="M">MASCULINO</option>';

		$('#genp').html(htm);
	});

	function valor(e){
		var option = e.options[e.selectedIndex];
		htm = "";
		if(option.text== "MADRE"){
			htm += '<option value="F">FEMENINO</option><option value="M">MASCULINO</option>';
		}
		else if(option.text == "PADRE"){
			htm += '<option value="M">MASCULINO</option><option value="F">FEMENINO</option>';
		}
		else htm += '<option value="" disabled selected>Seleccione Género</option><option value="F">FEMENINO</option><option value="M">MASCULINO</option>';

		$('#genpa').html(htm);
	}
</script>

<script>
	$.ajax({
		type:'GET',
		url:'{{ route('recuperar.fecha') }}',
		success:function(html){
			$('#datepicker-disabled-past5').datepicker('setStartDate', html[0]);
    		$('#datepicker-disabled-past5').datepicker('setEndDate', html[1]);
			$('#datepicker-disabled-past4').datepicker('setStartDate', html[0]);
    		$('#datepicker-disabled-past4').datepicker('setEndDate', html[1]);
			$('#datepicker-disabled-past3').datepicker('setStartDate', html[0]);
    		$('#datepicker-disabled-past3').datepicker('setEndDate', html[1]);
			$('#datepicker-disabled-past2').datepicker('setStartDate', html[0]);
    		$('#datepicker-disabled-past2').datepicker('setEndDate', html[1]);
			$('#datepicker-disabled-past').datepicker('setStartDate', html[0]);
    		$('#datepicker-disabled-past').datepicker('setEndDate', html[1]);
		}
		
	});
	
</script>

<script>
	$.ajax({
		type:'GET',
		url:'{{ route('listar.ocupacion') }}',
		success:function(html){
			$('#ocup').html(html);
		}
		
	});

	function listar_ocupacion(){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.ocupacion') }}',
			success:function(html){
				$('#ocup').html(html);
			}
			
		});
	}

	function listar_ocupacion2(){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.ocupacion') }}',
			success:function(html){
				$('#ocup').html(html);
				$('#ocupe').html(html);
				$('#ocupa').html(html);
			}
			
		});
	}

	$.ajax({
			type:'GET',
			url:'{{ route('listar.parentesco') }}',
			success:function(html){
				$('#paren').html(html);
			}
			
		});

	function listar_parentesco(){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.parentesco') }}',
			success:function(html){
				$('#paren').html(html);
			}
			
		});
	}
	
</script>

<script>
	function buscar(){
		let ci = $('#cip').val();
		if(ci != ''){
			$.ajax({
				type:'POST',
				url:"{{ route('buscar.persona') }}",
				data:{ _token: '{{ csrf_token ()}}', no:ci},
				success:function(html){
					if(html[0] == 1){
						swal({ icon: "success", title: "Datos encontrados, llenando campos"});
						$('#ape_patp').val(html[1][0]);
						$('#ape_matp').val(html[1][1]);
						$('#nombrep').val(html[1][2]);
						$('#fechap').val(html[1][4]);
						$('#tel_persp').val(html[1][8]);
						$('#telp').val(html[1][7]);
						htm = "";
						if(html[1][5] == "M"){
							htm += '<option value="M">MASCULINO</option><option value="F">FEMENINO</option>'
						}
						else if(html[1][5] == "F"){
							htm += '<option value="F">FEMENINO</option><option value="M">MASCULINO</option>'
						}
						$('#genp').html(htm);

						$.ajax({
							type:'POST',
							url:"{{ route('mostrar.ocupacion') }}",
							data:{ _token: '{{ csrf_token ()}}', id:html[1][6]},
							success:function(htm){
								$('#ocup').html(htm);
							}
							
						});
						$('#domp').val(html[1][9]);
					}
					else if(html == 2){
						swal({ icon: "warning", title: "No se encuentra registrado"});
					}
					else swal({ icon: "error", title: "Ha ocurrido un error"});
				}
				
			});
		}
		else swal({ icon: "warning", title: "Introduzca una CI"});
	}

	function buscar2(){
		let ci = $('#cipa').val();
		if(ci != ''){
			$.ajax({
				type:'POST',
				url:"{{ route('buscar.persona') }}",
				data:{ _token: '{{ csrf_token ()}}', no:ci},
				success:function(html){
					if(html[0] == 1){
						swal({ icon: "success", title: "Datos encontrados, llenando campos"});
						$('#ape_patpa').val(html[1][0]);
						$('#ape_matpa').val(html[1][1]);
						$('#nombrepa').val(html[1][2]);
						$('#fechapa').val(html[1][4]);
						$('#tel_perspa').val(html[1][8]);
						$('#telpa').val(html[1][7]);
						htm = "";
						if(html[1][5] == "M"){
							htm += '<option value="M">MASCULINO</option><option value="F">FEMENINO</option>'
						}
						else if(html[1][5] == "F"){
							htm += '<option value="F">FEMENINO</option><option value="M">MASCULINO</option>'
						}
						$('#genpa').html(htm);

						$.ajax({
							type:'POST',
							url:"{{ route('mostrar.ocupacion') }}",
							data:{ _token: '{{ csrf_token ()}}', id:html[1][6]},
							success:function(htm){
								$('#ocupa').html(htm);
							}
							
						});
						$('#dompa').val(html[1][9]);
					}
					else if(html == 2){
						swal({ icon: "warning", title: "No se encuentra registrado"});
					}
					else swal({ icon: "error", title: "Ha ocurrido un error"});
				}
				
			});
		}
		else swal({ icon: "warning", title: "Introduzca una CI"});
	}
</script>

<script>
    $(document).on("submit" ,"#registrar", function(e){
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr('content')
        });
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            datatype: 'html',
            success: function(html){
                if(html == 1){
					$('#lista').DataTable().ajax.reload();
                    swal({ icon: "success", title: "Se ha registrado correctamente"});
					
					$('#cip').val('');
					listar_parentesco();
					$('#ape_patp').val('');
					$('#ape_matp').val('');
					$('#nombrep').val('');
					$('#fechap').val('');
					$('#tel_persp').val('');
					$('#telp').val('');
					$('#domp').val('');
					htm = "";
					htm += '<option value="" disabled selected>Seleccione Género</option><option value="F">FEMENINO</option><option value="M">MASCULINO</option>';
					$('#genp').html(htm);

					listar_ocupacion();
                }
				else if(html == 2){
                    swal({ icon: "warning", title: "Ya se encuentra registrado"});
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo registrar"});
                }
                
            }
        });
    });

	$(document).on("submit" ,"#registraro", function(e){
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr('content')
        });
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            datatype: 'html',
            success: function(html){
                if(html == 1){
					listar_ocupacion2();
                    swal({ icon: "success", title: "Se ha registrado correctamente"});
					$('#modal-without-animation2').modal('hide');
					$('#fullname').val('');
                }
				else if(html == 2){
                    swal({ icon: "warning", title: "Ya se encuentra registrado"});
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo registrar"});
                }
                
            }
        });
    });

	$(document).on("submit" ,"#enviara", function(e){
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr('content')
        });
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            datatype: 'html',
            success: function(html){
                if(html == 1){
					$('#lista').DataTable().ajax.reload();
                    swal({ icon: "success", title: "Se ha actualizado correctamente"});
					$('#modal-dialog').modal('hide');
                }
				else if(html == 2){
                    swal({ icon: "warning", title: "El C.I. ya se encuentra registrado"});
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo actualizar"});
                }
                
            }
        });
    });

	$(document).on("submit" ,"#enviarb", function(e){
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr('content')
        });
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            datatype: 'html',
            success: function(html){
                if(html == 1){
					$('#lista').DataTable().ajax.reload();
                    swal({ icon: "success", title: "Se ha actualizado correctamente"});
					$('#modal-dialog2').modal('hide');
                }
				else if(html == 2){
                    swal({ icon: "warning", title: "El C.I. ya se encuentra registrado"});
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo actualizar"});
                }
                
            }
        });
    });

	$(document).on("submit" ,"#enviarc", function(e){
        $.ajaxSetup({
            header: $('meta[name="_token"]').attr('content')
        });
        e.preventDefault(e);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            datatype: 'html',
            success: function(html){
                if(html[0] == 1){
					$('#lista').DataTable().ajax.reload();
                    swal({ icon: "success", title: "Se ha registrado correctamente"});
					$('#modal-without-animation').modal('hide');
					$('#modal-dialog3').modal('hide');
					obtener(html[1]);
					$('#modal-without-animation').modal('show');
                }
				else if(html[0] == 2){
                    swal({ icon: "warning", title: "El C.I. ya se encuentra registrado"});
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo registrar"});
                }
                
            }
        });
    });
</script>

<script>
    function convertirEnMayusculas(e){
        e.value = e.value.toUpperCase();
    }

    function solo_letras (e) {
        key=e.keyCode || e.which;
        teclado=String.fromCharCode(key).toLowerCase();
        letras_num=" abcdefghijklmnñopqrstuvwxyz";
        especiales="8-37-38-46-164";
        teclado_especial=false;
        for (var i in especiales) {
            if (key==especiales[i]) {
                teclado_especial=true;break;
            }
        }
        if (letras_num.indexOf(teclado)==-1 && !teclado_especial) {
            return false;
        }
    }

    function solo_numeros (e) {
        key=e.keyCode || e.which;
        teclado=String.fromCharCode(key).toLowerCase();
        letras_num="1234567890";
        especiales="8-37-38-46-164";
        teclado_especial=false;
        for (var i in especiales) {
            if (key==especiales[i]) {
                teclado_especial=true;break;
            }
        }
        if (letras_num.indexOf(teclado)==-1 && !teclado_especial) {
            return false;
        }
    }

    function solo_letras_ci (e) {
        key=e.keyCode || e.which;
        teclado=String.fromCharCode(key).toLowerCase();
        letras_num="abcdefghijklmnñopqrstuvwxyz-1234567890";
        especiales="8-37-38-46-164";
        teclado_especial=false;
        for (var i in especiales) {
            if (key==especiales[i]) {
                teclado_especial=true;break;
            }
        }
        if (letras_num.indexOf(teclado)==-1 && !teclado_especial) {
            return false;
        }
    }

    function solo_letras_domicilio (e) {
        key=e.keyCode || e.which;
        teclado=String.fromCharCode(key).toLowerCase();
        letras_num=" abcdefghijklmnñopqrstuvwxyz-/º1234567890";
        especiales="8-37-38-46-164";
        teclado_especial=false;
        for (var i in especiales) {
            if (key==especiales[i]) {
                teclado_especial=true;break;
            }
        }
        if (letras_num.indexOf(teclado)==-1 && !teclado_especial) {
            return false;
        }
    }

	function control(){

		if($('#ape_patp').val() == '' && $('#ape_matp').val() == ''){
			$('#ape_patp').prop("required", true);
			$('#ape_matp').prop("required", true);
			swal({ icon: "warning", title: "Debe llenar el campo Apellido Paterno o Apellido Materno"});
		}else{
			$('#ape_patp').prop("required", false);
			$('#ape_matp').prop("required", false);
		}
	}

	function control2(){

		if($('#ape_pate').val() == '' && $('#ape_mate').val() == ''){
			$('#ape_pate').prop("required", true);
			$('#ape_mate').prop("required", true);
			swal({ icon: "warning", title: "Debe llenar el campo Apellido Paterno o Apellido Materno"});
		}else{
			$('#ape_pate').prop("required", false);
			$('#ape_mate').prop("required", false);
		}
	}

	function control3(){

		if($('#ape_patpe').val() == '' && $('#ape_matpe').val() == ''){
			$('#ape_patpe').prop("required", true);
			$('#ape_matpe').prop("required", true);
			swal({ icon: "warning", title: "Debe llenar el campo Apellido Paterno o Apellido Materno"});
		}else{
			$('#ape_patpe').prop("required", false);
			$('#ape_matpe').prop("required", false);
		}
	}

	function control4(){

		if($('#ape_patpa').val() == '' && $('#ape_matpa').val() == ''){
			$('#ape_patpa').prop("required", true);
			$('#ape_matpa').prop("required", true);
			swal({ icon: "warning", title: "Debe llenar el campo Apellido Paterno o Apellido Materno"});
		}else{
			$('#ape_patpa').prop("required", false);
			$('#ape_matpa').prop("required", false);
		}
	}
</script>

    <script src="assets/plugins/parsleyjs/dist/parsley.js"></script>
    <script src="assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="assets/js/demo/form-wizards-validation.demo.js"></script>
    <script src="assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="assets/plugins/moment/min/moment.min.js"></script>
	<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="assets/js/demo/form-plugins.demo.js"></script>
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
	<script src="assets/js/demo/ui-modal-notification.demo.js"></script>
	<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/js/demo/table-manage-responsive.demo.js"></script>

<script>
    $('#wizard').smartWizard({
        lang: { 
            next: 'Siguiente',
            previous: 'Anterior'
            
        }
    });


    $("#wizard").on("leaveStep",function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
                        
		if(stepNumber === 0){
			var bandera = true;
			if($('#ape_pat').val() == '' && $('#ape_mat').val() == ''){
				$("input[name='ape_pat']").prop("required", true);
				$("input[name='ape_mat']").prop("required", true);
				bandera = false;
			}else{
				$("input[name='ape_pat']").prop("required", false);
				$("input[name='ape_mat']").prop("required", false);
			}
			return bandera;
		}

		if(stepNumber === 1){
			var bandera = true;
			if($('#ape_patp').val() == '' && $('#ape_matp').val() == ''){
				$("input[name='ape_patp']").prop("required", true);
				$("input[name='ape_matp']").prop("required", true);
				bandera = false;
			}else{
				$("input[name='ape_patp']").prop("required", false);
				$("input[name='ape_matp']").prop("required", false);
			}
			return bandera;
		}
		
	});
</script>
@endpush