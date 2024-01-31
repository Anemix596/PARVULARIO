@extends('layouts.default')

@section('title', 'Registro de Devoluciones')

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
	<h1 class="page-header">Registrar Devolución <small>Realiza la devolución correspondiente</small></h1>
	
	<div class="col-xl-12">

		<div class="panel panel-info">
			
			<div class="panel-heading">
				<h4 class="panel-title">LISTA DE INSCRIPCIONES VIGENTES</h4>
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
                    <h4 class="modal-title">Editar Devolución</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        <form action="{{ route('actualizar.datos.devolucion')}}" id="actualizar" method="POST" name="" class="form-control-with-bg">
                            @csrf
							<input type="hidden" name="ide" id="ide" value="">
							<label id="mensaje" style="background: red; color:white; font-weight: bold"></label>
							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-6">
											<p class="mb-2">Estudiante <span class="text-danger">*</span></p>
											<input type="hidden" name="est_id" id="est_id" value="">
											<input type="text" id="est2" name="est2" placeholder="INGRESE NOMBRE COMPLETO" class="form-control" disabled/>
											
										</div>
										<div class="col-6">
											<p class="mb-2">Tutor <span class="text-danger">*</span></p>
											<select class="default-select2 form-control" name="tutor2" id="tutor2" required>
							
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-12">
											<p class="mb-2">Motivo de Devolución <span class="text-danger"></span></p>
											<textarea class="form-control" id="motivo" name="motivo" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*" rows="2" minlength="1" maxlength="200" placeholder="CANTIDAD MÁXIMA DE LETRAS: 100" data-size="10" data-live-search="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_numeros(event)" required></textarea>
										</div>
									</div>
								</div>
							</div>
			
							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-4">
											<p class="mb-2">Turno <span class="text-danger">*</span></p>
											<input type="text" id="turno2" name="turno2" placeholder="INGRESE TURNO" class="form-control" disabled/>
										</div>
										
										<div class="col-5">
											<input type="hidden" name="niv" id="niv" value="">
											<p class="mb-2">Nivel <span class="text-danger">*</span></p>
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
											<div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy">
												<input type="hidden" name="fechai" id="fechai" value="">
												<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechai2" name="fechai2" required readonly disabled/>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
										<div class="col-4">
											<p class="mb-2">Fecha Final <span class="text-danger">*</span></p>
											<div class="input-group date" id="datepicker-disabled-past2" data-date-format="dd-mm-yyyy">
												<input type="hidden" name="fechaf" id="fechaf" value="">
												<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechaf2" name="fechaf2" required readonly disabled/>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
										<div class="col-4">
											<p class="mb-2">Monto Pagado <span class="text-danger"> </span></p>
											<input type="hidden" name="prec" id="prec" value="">
											<input type="text" id="precio2" name="precio2" placeholder="INGRESE EL PRECIO" class="form-control" required disabled/>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-6">
											<p class="mb-2">Cant. de Días <span class="text-danger"> </span></p>
											<input type="text" id="cant2" name="cant2" placeholder="INGRESE CANTIDAD DE DÍAS" class="form-control" onkeyup="calcular_precio()" onkeypress="return solo_numeros(event)" required/>
										</div>
										<div class="col-6">
											<p class="mb-2">Monto a Devolver <span class="text-danger"> </span></p>
											<input type="text" id="precio" name="precio" placeholder="INGRESE EL PRECIO" class="form-control" onkeypress="return solo_numeros_precio(event)" required/>
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

	<div class="modal fade" id="modal-dialog4" role="dialog" style="overflow-y: scroll">
        <div class="modal-dialog" style="max-width: 50% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar Devolución</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        <form action="{{ route('registrar.datos.devolucion')}}" id="registrar" method="POST" name="" class="form-control-with-bg">
                            @csrf
							<input type="hidden" name="idea" id="idea" value="">
							<label id="mensajea" style="background: red; color:white; font-weight: bold"></label>
							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-6">
											<p class="mb-2">Estudiante <span class="text-danger">*</span></p>
											<input type="hidden" name="est_ida" id="est_ida" value="">
											<input type="text" id="est2a" name="est2a" placeholder="INGRESE NOMBRE COMPLETO" class="form-control" disabled/>
											
										</div>
										<div class="col-6">
											<p class="mb-2">Tutor <span class="text-danger">*</span></p>
											<select class="default-select2 form-control" name="tutor2a" id="tutor2a" required>
							
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-12">
											<p class="mb-2">Motivo de Devolución <span class="text-danger"></span></p>
											<textarea class="form-control" id="motivoa" name="motivoa" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*" rows="2" minlength="1" maxlength="200" placeholder="CANTIDAD MÁXIMA DE LETRAS: 100" data-size="10" data-live-search="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras_numeros(event)" required></textarea>
										</div>
									</div>
								</div>
							</div>
			
							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-4">
											<p class="mb-2">Turno <span class="text-danger">*</span></p>
											<input type="text" id="turno2a" name="turno2a" placeholder="INGRESE TURNO" class="form-control" disabled/>
										</div>
										
										<div class="col-5">
											<input type="hidden" name="niva" id="niva" value="">
											<p class="mb-2">Nivel <span class="text-danger">*</span></p>
											<input type="text" id="nivel2a" name="nivel2a" placeholder="INGRESE NIVEL" class="form-control" disabled/>
										</div>
										<div class="col-3">
											<p class="mb-2">Periodo <span class="text-danger">*</span></p>
											<input type="text" id="periodo2a" name="periodo2a" placeholder="INGRESE PERIODO" class="form-control" disabled/>
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
												<input type="hidden" name="fechaia" id="fechaia" value="">
												<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechai2a" name="fechai2a" required readonly disabled/>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
										<div class="col-4">
											<p class="mb-2">Fecha Final <span class="text-danger">*</span></p>
											<div class="input-group date" id="datepicker-disabled-past4" data-date-format="dd-mm-yyyy">
												<input type="hidden" name="fechafa" id="fechafa" value="">
												<input type="text" class="form-control" placeholder="Seleccione Fecha" id="fechaf2a" name="fechaf2a" required readonly disabled/>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
										<div class="col-4">
											<p class="mb-2">Monto Pagado <span class="text-danger"> </span></p>
											<input type="hidden" name="preca" id="preca" value="">
											<input type="text" id="precio2a" name="precio2a" placeholder="INGRESE EL PRECIO" class="form-control" required disabled/>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group row m-b-12">
								<div class="col-lg-9 col-xl-12">
									<div class="row row-space-6">
										<div class="col-6">
											<p class="mb-2">Cant. de Días <span class="text-danger"> </span></p>
											<input type="text" id="cant2a" name="cant2a" placeholder="INGRESE CANTIDAD DE DÍAS" class="form-control" onkeyup="calcular_precio2()" onkeypress="return solo_numeros(event)" required/>
										</div>
										<div class="col-6">
											<p class="mb-2">Monto a Devolver <span class="text-danger"> </span></p>
											<input type="text" id="precioa" name="precioa" placeholder="INGRESE EL PRECIO" class="form-control" onkeypress="return solo_numeros_precio(event)" required/>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="text-center">
								<button class="btn btn-primary btn-lg" type="submit" id="regi">Registrar Datos</button>
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
					$('#modal-dialog4').modal('hide');
					$('#lista').DataTable().ajax.reload();
                    swal({ icon: "success", title: "Se ha registrado correctamente"});
					$('#motivoa').val('');
					$('#cant2a').val('');
					$('#precioa').val('');
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

	$(document).on("submit" ,"#actualizar", function(e){
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
					$('#modal-dialog').modal('hide');
					$('#lista').DataTable().ajax.reload();
                    swal({ icon: "success", title: "Se ha actualizado correctamente"});
					$('#motivo').val('');
					$('#cant2').val('');
					$('#precio').val('');
					$('#tutor2').empty();
                }
				else if(html == 2){
                    swal({ icon: "warning", title: "Ya se encuentra actualizado"});
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo registrar"});
                }
                
            }
        });
    });
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
                    swal({ icon: "success", title: "Se ha registrado correctamente"});
					$('#modal-dialog').modal('hide');
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo registrar"});
                }
                
            }
        });
    });
</script>

<script>
	function registrar(e){
		$('#motivoa').val('')
		$('#cant2a').val('')
		$('#precioa').val('')
		$.ajax({
			type:'POST',
			url:"{{ route('obtener.inscripcion') }}",
			data:{ _token: '{{ csrf_token ()}}', id:e},
			success:function(htm){
				$('#mensajea').html(htm[12]);
				listar_tutores2(htm[13]);
				$('#niva').val(htm[14]);
				$('#est_ida').val(htm[13]);
				$('#idea').val(htm[11]);
				$('#est2a').val(htm[0]);
				$('#nivel2a').val(htm[3]);
				$('#periodo2a').val(htm[5]);
				$('#fechaia').val(htm[7]);
				$('#fechafa').val(htm[8]);
				$('#fechai2a').val(htm[7]);
				$('#fechaf2a').val(htm[8]);
				$('#preca').val(htm[9]);
				$('#precio2a').val(htm[9]);
				if(htm[4] == "M"){
					$('#turno2a').val('MAÑANA');
				}
				if(htm[4] == "T"){
					$('#turno2a').val('TARDE');
				}
			}
			
		});
	}

	function editar(e){
		$.ajax({
			type:'POST',
			url:"{{ route('obtener.devolucion') }}",
			data:{ _token: '{{ csrf_token ()}}', id:e},
			success:function(htm){
				$('#mensaje').html(htm[12]);
				listar_tutores(htm[13], htm[6]);
				$('#motivo').val(htm[1]);
				$('#precio').val(htm[9]);
				$('#cant2').val(htm[10]);
				$('#niv').val(htm[14]);
				$('#est_id').val(htm[13]);
				$('#ide').val(htm[11]);
				$('#est2').val(htm[0]);
				$('#nivel2').val(htm[3]);
				$('#periodo2').val(htm[5]);
				$('#fechai').val(htm[7]);
				$('#fechaf').val(htm[8]);
				$('#fechai2').val(htm[7]);
				$('#fechaf2').val(htm[8]);
				$('#prec').val(htm[2]);
				$('#precio2').val(htm[2]);
				if(htm[4] == "M"){
					$('#turno2').val('MAÑANA');
				}
				if(htm[4] == "T"){
					$('#turno2').val('TARDE');
				}
			}
			
		});
	}
</script>

<script>
    $(document).ready( function () {
        $('#lista').DataTable({
            "ajax": {
                url: "{{route('ver.lista.inscripcion2')}}",
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
            { orderable: false, targets: 7 }
            ],
        });
        
    });
</script>

<script>

	function listar_tutores(dato, dato2){
		$.ajax({
			type:'POST',
			url:"{{ route('listar.tutores2') }}",
			data:{ _token: '{{ csrf_token ()}}', ide:dato, idt:dato2},
			success:function(htm){
				$('#tutor2').html(htm);
			}
			
		});
		
	}

	function listar_tutores2(dato){
		$.ajax({
			type:'POST',
			url:"{{ route('listar.tutores') }}",
			data:{ _token: '{{ csrf_token ()}}', id:dato},
			success:function(htm){
				$('#tutor2a').html(htm);
			}
			
		});
	}

	function calcular_precio(){
		let fi = $('#fechai').val();
		let ff = $('#fechaf').val();
		let n = $('#niv').val();
		let d = $('#cant2').val();
		
		if(fi != '' && ff != '' && n != '' && d != ''){
			$.ajax({
				type:'POST',
				url:"{{ route('calcular.precio.devolucion') }}",
				data:{ _token: '{{ csrf_token ()}}', fi: fi, ff:ff, id:n, d:d},
				success:function(html){
					if(html[0] == 3){
						$('#precio').val('');
						swal({ icon: "warning", title: "La cantidad de días debe ser distinto de 0 y menor o igual a " + html[1]});
					}
					else if(html[0] == 1) $('#precio').val(html[1]);
				}
				
			});
		}
	}

	function calcular_precio2(){
		let fi = $('#fechaia').val();
		let ff = $('#fechafa').val();
		let n = $('#niva').val();
		let d = $('#cant2a').val();
		
		if(fi != '' && ff != '' && n != '' && d != ''){
			$.ajax({
				type:'POST',
				url:"{{ route('calcular.precio.devolucion') }}",
				data:{ _token: '{{ csrf_token ()}}', fi: fi, ff:ff, id:n, d:d},
				success:function(html){
					if(html[0] == 3){
						$('#precioa').val('');
						swal({ icon: "warning", title: "La cantidad de días debe ser distinto de 0 y menor o igual a " + html[1]});
					}
					else if(html[0] == 1) $('#precioa').val(html[1]);
				}
				
			});
		}
	}
</script>

<script>
	function calcular(e){
		if(e != '' && $('#fechai').val() !=''){
			let fecha = $('#fechai').val();
			$.ajax({
				type:'POST',
				url:"{{ route('calcular.fecha') }}",
				data:{ _token: '{{ csrf_token ()}}', f:fecha, d:e},
				success:function(html){
					$('#fechaf').val(html);
					calcular_precio();
				}
				
			});
		}
		else{
			if(e != '') calcular(e);
			else{
				$('#fechaf').val('');
				$('#precio').val('');
			}
		}
	}
</script>

<script>
	function iniciar_fecha(){
		$.ajax({
			type:'GET',
			url:'{{ route('recuperar.fecha') }}',
			success:function(html){
				$('#datepicker-disabled-past4').datepicker('setStartDate', html[1]);
			}
			
		});
	}
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