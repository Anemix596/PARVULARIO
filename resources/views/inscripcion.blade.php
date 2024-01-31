@extends('layouts.default')

@section('title', 'Registro de Inscripciones')

@push('css')
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
    <!-- begin breadcrumb -->
			
	<!-- begin page-header -->
	<h1 class="page-header">Registrar Inscripción/Reinscripción <small>Realiza la inscripción correspondiente</small></h1>
	<!-- end page-header -->
	<!-- begin wizard-form -->
	<div class="panel panel-inverse" data-sortable-id="form-validation-1">
		
		<!-- begin panel-body -->
		<div class="panel-body">
			<form action="{{ route('registrar.inscripcion') }}" data-parsley-validate="true" method="POST" name="form-wizard" id="registrar" class="form-horizontal">
				@csrf
				<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Información del Niño/Niña</legend>
					
				<div class="form-group row m-b-12">
					<div class="col-lg-9 col-xl-12">
						<div class="row row-space-6">
							<div class="col-6">
								<p class="mb-2">Estudiante <span class="text-danger">*</span></p>
								<select class="default-select2 form-control" name="est" id="est" onchange="listar_tutores(this.value)">
							
								</select>
							</div>
							<div class="col-6">
								<p class="mb-2">Tutor <span class="text-danger">*</span></p>
								<select class="default-select2 form-control" name="tutor" id="tutor" required>
							
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row m-b-12">
					<div class="col-lg-9 col-xl-12">
						<div class="row row-space-6">
							<div class="col-6">
								<p class="mb-2">Aspectos Importantes <span class="text-danger"></span></p>
								<textarea class="form-control" id="aspecto" name="aspecto" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*" rows="2" minlength="1" maxlength="200" placeholder="CANTIDAD MÁXIMA DE LETRAS: 100" data-size="10" data-live-search="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_numeros(event)"></textarea>
							</div>
							<div class="col-6">
								<p class="mb-2">Vive con <span class="text-danger"></span></p>
								<textarea class="form-control" id="vive" name="vive" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*" rows="2" minlength="1" maxlength="200" placeholder="CANTIDAD MÁXIMA DE LETRAS: 100" data-size="10" data-live-search="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_numeros(event)"></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row m-b-12">
					<div class="col-lg-9 col-xl-12">
						<div class="row row-space-6">
							<div class="col-4">
								<p class="mb-2">Turno <span class="text-danger">*</span></p>
								<select class="default-select2 form-control" name="turno" id="turno" required>
									<option value="" disabled selected>Seleccione Turno</option>
									<option value="M">MAÑANA</option>
									<option value="T">TARDE</option>
								</select>
							</div>
							
							<div class="col-5">
								<p class="mb-2">Nivel <span class="text-danger">*</span></p>
								<input type="hidden" name="niv" id="niv" value="">
								<select class="default-select2 form-control" name="nivel" id="nivel" onchange="calcular_precio()" required>
									
								</select>
							</div>
							<div class="col-3">
								<p class="mb-2">Periodo <span class="text-danger">*</span></p>
								<select class="default-select2 form-control" name="periodo" id="periodo" required>
									
								</select>
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group row m-b-12">
					<div class="col-lg-9 col-xl-12">
						<div class="row row-space-6">
							<div class="col-4">
								<p class="mb-2">Fecha de Asistencia <span class="text-danger">*</span></p>
								<div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy">
									<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechai" name="fechai" onchange="desbloquear(this.value)" required readonly disabled/>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
							<div class="col-4">
								<p class="mb-2">Fecha Final <span class="text-danger">*</span></p>
								<div class="input-group date" id="datepicker-disabled-past2" data-date-format="dd-mm-yyyy">
									<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechaf" name="fechaf" onchange="calcular_precio()" required readonly disabled/>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
							<div class="col-4">
								<p class="mb-2">Precio <span class="text-danger"> </span></p>
								<input type="text" id="precio" name="precio" placeholder="INGRESE EL PRECIO" class="form-control" onkeypress="return solo_numeros_precio(event)" required disabled/>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row m-b-0">
					<label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
					<div class="col-md-8 col-sm-8">
						<button type="submit" class="btn btn-primary">Registrar Inscripción</button>
					</div>
				</div>
				
			</form>
			<!-- end wizard-form -->
		</div>
	</div>

	<div class="col-xl-12">

		<div class="panel panel-info">
			
			<div class="panel-heading">
				<h4 class="panel-title">LISTA DE INSCRIPCIONES</h4>
			</div>
			
			
			<div class="panel-body">
				<div class="table-responsive">
					<table id="lista" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">Nº</th>
								<th class="text-nowrap">CI</th>
								<th class="text-nowrap">NOMBRE COMPLETO</th>
								<th class="text-nowrap">NIVEL</th>
								<th class="text-nowrap">TURNO</th>
								<th class="text-nowrap">FECHA DE ASISTENCIA</th>
								<th class="text-nowrap">FECHA DE FINALIZACIÓN</th>
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

	<div class="modal fade" id="modal-dialog" role="dialog" style="overflow-y: scroll">
        <div class="modal-dialog" style="max-width: 50% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar datos de la Inscripción</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        <form action="{{ route('actualizar.datos.inscrip')}}" id="enviara" method="POST" name="" class="form-control-with-bg">
                            @csrf
							<input type="hidden" name="ide" id="ide" value="">
							<label id="mensaje" style="background: red; color:white; font-weight: bold"></label>
							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-6">
											<p class="mb-2">Estudiante <span class="text-danger">*</span></p>
											<input type="text" id="est2" name="est2" placeholder="INGRESE NOMBRE COMPLETO" class="form-control" disabled/>
											
										</div>
										<div class="col-6">
											<p class="mb-2">Tutor <span class="text-danger">*</span></p>
											<input type="text" id="tutor2" name="tutor2" placeholder="INGRESE NOMBRE COMPLETO" class="form-control" disabled/>
										</div>
									</div>
								</div>
							</div>
			
							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-6">
											<p class="mb-2">Aspectos Importantes <span class="text-danger"></span></p>
											<textarea class="form-control" id="aspecto2" name="aspecto2" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*" rows="2" minlength="1" maxlength="200" placeholder="CANTIDAD MÁXIMA DE LETRAS: 100" data-size="10" data-live-search="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_numeros(event)"></textarea>
										</div>
										<div class="col-6">
											<p class="mb-2">Vive con <span class="text-danger"></span></p>
											<textarea class="form-control" id="vive2" name="vive2" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*" rows="2" minlength="1" maxlength="200" placeholder="CANTIDAD MÁXIMA DE LETRAS: 100" data-size="10" data-live-search="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_numeros(event)"></textarea>
										</div>
									</div>
								</div>
							</div>
			
							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-4">
											<p class="mb-2">Turno <span class="text-danger">*</span></p>
											<select class="default-select2 form-control" name="turno2" id="turno2" required>
												<option value="" disabled selected>Seleccione Turno</option>
												<option value="M">MAÑANA</option>
												<option value="T">TARDE</option>
											</select>
										</div>
										
										<div class="col-5">
											<p class="mb-2">Nivel <span class="text-danger">*</span></p>
											<input type="hidden" name="niv2" id="niv2" value="">
											<input type="text" id="nivel2" name="nivel2" placeholder="INGRESE NIVEL" class="form-control" disabled/>
										</div>
										<div class="col-3">
											<p class="mb-2">Periodo <span class="text-danger">*</span></p>
											<input type="text" id="periodo2" name="periodo2" placeholder="INGRESE PERIODO" class="form-control" disabled/>
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-4">
											<p class="mb-2">Fecha de Asistencia <span class="text-danger">*</span></p>
											<div class="input-group date" id="datepicker-disabled-past3" data-date-format="dd-mm-yyyy">
												<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechai2" name="fechai2" onchange="dato_fechaf(this.value)" required readonly/>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
										<div class="col-4">
											<p class="mb-2">Fecha Final <span class="text-danger">*</span></p>
											<div class="input-group date" id="datepicker-disabled-past4" data-date-format="dd-mm-yyyy">
												<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechaf2" name="fechaf2" onchange="calcular_precio2()" required readonly/>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
										<div class="col-4">
											<p class="mb-2">Precio <span class="text-danger"> </span></p>
											<input type="text" id="precio2" name="precio2" placeholder="INGRESE EL PRECIO" class="form-control" onkeypress="return solo_numeros_precio(event)" required/>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="text-center">
								<button class="btn btn-primary btn-lg" type="submit" id="actual">Actualizar Datos</button>
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
	
@endsection

@push('scripts')

<script>
    function recibo(e){
        $.ajax({
            type:'POST',
            url:'{{ route('imprimir.recibo') }}',
            data:{ _token: '{{ csrf_token ()}}', id:e},
            success:function(html){
                window.open(html, '_blank');
            }
            
        });
    }
</script>

<script>
	var $select =$("#periodo").change(function(){
		var e = $(this).val();
		$('#periodo').val(e);
		desbloquear2($('#periodo').val());
		fecha_ultima($('#est').val());
	});

	var $select =$("#est").change(function(){
		var e = $(this).val();
		$('#est').val(e);
		fecha_ultima($('#est').val());
	});

	function fecha_ultima(e){
		$.ajax({
			type:'POST',
			url:"{{ route('obtener.fecha.ultima') }}",
			data:{ _token: '{{ csrf_token ()}}', id:e},
			success:function(htm){
				if(htm != '')
					$('#fechai').val(htm);
				desbloquear($('#fechai').val());
				calcular_precio();
			}
			
		});
	}
</script>

<script>
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
                else{
                    swal({ icon: "error", title: "Error, no se pudo actualizar"});
                }
                
            }
        });
    });
</script>

<script>
	function editar(e){
		$('#actual').hide();
		$.ajax({
			type:'POST',
			url:"{{ route('obtener.inscripcion') }}",
			data:{ _token: '{{ csrf_token ()}}', id:e},
			success:function(htm){
				$('#mensaje').html(htm[12]);
				if(htm[10] == "A") $('#actual').show();
				if(htm[10] == "B") $('#actual').hide();
				$('#ide').val(htm[11]);
				$('#est2').val(htm[0]);
				$('#tutor2').val(htm[6]);
				$('#aspecto2').val(htm[1]);
				$('#vive2').val(htm[2]);
				$('#nivel2').val(htm[3]);
				$('#niv2').val(htm[14]);
				$('#periodo2').val(htm[5]);
				$('#fechai2').val(htm[7]);
				const f = htm[5], fe=f.split("/");
				let dias = new Date(fe[1], fe[0], 0).getDate();
				let fecha = "01-"+(parseInt(fe[0])<10?"0"+fe[0]:fe[0])+"-"+fe[1];
				let fecha2 = dias+"-"+(parseInt(fe[0])<10?"0"+fe[0]:fe[0])+"-"+fe[1];
				$('#datepicker-disabled-past3').datepicker('setStartDate', fecha);
				$('#datepicker-disabled-past3').datepicker('setEndDate', fecha2);
				$('#datepicker-disabled-past4').datepicker('setStartDate', fecha);
				$('#fechaf2').val(htm[8]);
				$('#precio2').val(htm[9]);
				htma = "";
				if(htm[4] == "M"){
					htma += '<option value="M">MAÑANA</option><option value="T">TARDE</option>'
				}
				if(htm[4] == "T"){
					htma += '<option value="T">TARDE</option><option value="M">MAÑANA</option>'
				}
				$('#turno2').html(htma);
			}
			
		});
	}
</script>

<script>
    $(document).ready( function () {
        $('#lista').DataTable({
            "ajax": {
                url: "{{route('ver.lista.inscripcion')}}",
                type: 'GET'
            },
            columns: [
						{data:'numero'  , name: 'numero'}, 
                        {data: 'ci' , name: 'ci'}, 
                        {data: 'est' , name: 'est'},
						{data: 'nivel' , name: 'nivel'},
						{data: 'turno' , name: 'turno'},
						{data: 'fechai' , name: 'fechai'},
						{data: 'fechaf' , name: 'fechaf'},
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
            { orderable: false, targets: 3 }
            ],
        });
        
    });
</script>

<script>
	function desbloquear2(e){
		if(e != ''){
			const f = e, fe=f.split("/");
			let dias = new Date(fe[1], fe[0], 0).getDate();
			let fecha = "01-"+(parseInt(fe[0])<10?"0"+fe[0]:fe[0])+"-"+fe[1];
			let fecha2 = dias+"-"+(parseInt(fe[0])<10?"0"+fe[0]:fe[0])+"-"+fe[1];
			
			$("#datepicker-disabled-past").datepicker();
			$('#datepicker-disabled-past').datepicker('setStartDate', fecha);
			$('#datepicker-disabled-past').datepicker('setEndDate', fecha2);
			$("#fechai").prop('disabled', false);
		}
		else{
			$("#datepicker-disabled-past").datepicker("disabled");	
			$("#fechai").prop('disabled', true);
			
		}
	}

	function desbloquear(e){
		if(e != ''){
			let fecha = $("#fechai").val();
			$("#datepicker-disabled-past2").datepicker();
			$('#datepicker-disabled-past2').datepicker('setStartDate', fecha);
			$("#fechaf").prop('disabled', false);
			$("#precio").prop('disabled', false);
			calcular_precio();
		}
		else{
			$("#datepicker-disabled-past2").datepicker("disabled");	
			$("#fechaf").prop('disabled', true);
			$("#precio").prop('disabled', true);
			
		}
	}

	var $select =$("#nivel").change(function(){
		var e = $(this).val();
		$('#niv').val(e);
	});

	function calcular_precio(){
		let fi = $('#fechai').val();
		let ff = $('#fechaf').val();
		let n = $('#niv').val();
		
		if(fi != '' && ff != '' && n != ''){
			$.ajax({
				type:'POST',
				url:"{{ route('calcular.precio') }}",
				data:{ _token: '{{ csrf_token ()}}', fi: fi, ff:ff, id:n},
				success:function(html){
					$('#precio').val(html);
				}
				
			});
		}
	}

	function calcular_precio2(){
		let fi = $('#fechai2').val();
		let ff = $('#fechaf2').val();
		let n = $('#niv2').val();
		
		if(fi != '' && ff != '' && n != ''){
			$.ajax({
				type:'POST',
				url:"{{ route('calcular.precio') }}",
				data:{ _token: '{{ csrf_token ()}}', fi: fi, ff:ff, id:n},
				success:function(html){
					$('#precio2').val(html);
				}
				
			});
		}
	}
</script>

<script>

	$.ajax({
		type:'GET',
		url:'{{ route('listar.ninos') }}',
		success:function(html){
			$('#est').html(html);
		}
		
	});

	function listar_ninos(){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.ninos') }}',
			success:function(html){
				$('#est').html(html);
			}
			
		});
	}

	$.ajax({
		type:'GET',
		url:'{{ route('listar.nivel') }}',
		success:function(html){
			$('#nivel').html(html);
		}
		
	});

	function listar_nivel(){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.nivel') }}',
			success:function(html){
				$('#nivel').html(html);
			}
			
		});
	}

	$.ajax({
		type:'GET',
		url:'{{ route('listar.periodo') }}',
		success:function(html){
			$('#periodo').html(html);
		}
		
	});

	function listar_periodo(){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.periodo') }}',
			success:function(html){
				$('#periodo').html(html);
			}
			
		});
	}

	function listar_tutores(dato){
		$.ajax({
			type:'POST',
			url:"{{ route('listar.tutores') }}",
			data:{ _token: '{{ csrf_token ()}}', id:dato},
			success:function(htm){
				$('#tutor').html(htm);
			}
			
		});
	}
</script>

<script>
	function dato_fechaf(e){
		if(e != ''){
			let fecha = $("#fechai2").val();
			$("#datepicker-disabled-past4").datepicker();
			$('#datepicker-disabled-past4').datepicker('setStartDate', fecha);
			$("#fechaf2").prop('disabled', false);
			$("#precio2").prop('disabled', false);
		}
		else{
			$("#datepicker-disabled-past4").datepicker("disabled");	
			$("#fechaf2").prop('disabled', true);
			$("#precio2").prop('disabled', true);
			
		}
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
					listar_ninos();
					$('#tutor').empty();
					listar_nivel();
					listar_periodo();
					htm = '<option value="" disabled selected>Seleccione Turno</option><option value="M">MAÑANA</option><option value="T">TARDE</option>';
					
					$('#turno').html(htm);
                    swal({ icon: "success", title: "Se ha registrado correctamente"});
					$('#aspecto').val('');
					$('#vive').val('');
					$('#fechai').val('');
					$('#fechaf').val('');
					$("#datepicker-disabled-past2").datepicker("disabled");
					$('#fechaf').prop('disabled', true);
					$('#precio').val('');
					$('#precio').prop('disabled', true);
                }
				else if(html == 2){
                    swal({ icon: "warning", title: "Su inscripción se encuentra en vigencia"});
                }
				else if(html == 3){
                    swal({ icon: "warning", title: "El periodo se está llevando actualmente"});
                }
				else if(html == 4){
                    swal({ icon: "warning", title: "Debe completar la fecha de inicio y fin de asistencia"});
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

	function solo_letras_numeros (e) {
        key=e.keyCode || e.which;
        teclado=String.fromCharCode(key).toLowerCase();
        letras_num=" abcdefghijklmnñopqrstuvwxyz,.-/1234567890";
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

	function solo_numeros_precio (e) {
        key=e.keyCode || e.which;
        teclado=String.fromCharCode(key).toLowerCase();
        letras_num="1234567890.";
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

</script>

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

@endpush