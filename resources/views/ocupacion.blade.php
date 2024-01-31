@extends('layouts.default')

@section('title', 'Registro de Ocupaciones')

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
	<h1 class="page-header">Registrar Ocupación</h1>
	<!-- end page-header -->
	<div class="panel panel-inverse" data-sortable-id="form-validation-1">
		
		<!-- begin panel-body -->
		<div class="panel-body">
			<form class="form-horizontal" data-parsley-validate="true" action="{{ route('agregar.ocupacion') }}" method="POST" name="form-wizard" id="registrar">
				@csrf
				<div class="form-group row m-b-15">
					<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Ocupación * :</label>
					<div class="col-md-8 col-sm-8">
						<input class="form-control" type="text" id="fullname" name="fullname" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE LA OCUPACION" data-parsley-required="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)" />
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
		<!-- end panel-body -->
		
	</div>

	<div class="col-xl-12">
        <div>
            <form class="form-horizontal" id="filtrar" data-parsley-validate="true" name="demo-form">
                <div class="col-md-9">
                    <h4 class="panel-title">Filtrar por Estado</h4>
                    <div class="checkbox checkbox-css is-valid">
                        <input type="checkbox" name="ped_pendiente" id="ped_pendiente" value="1" onchange="pendientes(this.value);"/>
                        <label for="ped_pendiente">Ocupaciones Activas</label>
                    </div>
                    <div class="checkbox checkbox-css is-invalid">
                        <input type="checkbox" name="ped_aprobado" id="ped_aprobado" value="2" onchange="aprobados(this.value);"/>
                        <label for="ped_aprobado">Ocupaciones Inactivas</label>
                    </div>
                </div>
            </form>
        </div>
        <br>
        
        
    </div>

	<div class="col-xl-12">

		<div class="panel panel-info">
			
			<div class="panel-heading">
				<h4 class="panel-title">LISTA DE OCUPACIONES REGISTRADOS</h4>
			</div>
			
			
			<div class="panel-body">
				<div class="table-responsive">
					<table id="lista" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">Nº</th>
								<th class="text-nowrap">DESCRIPCIÓN</th>
								<th class="text-nowrap">ESTADO</th>
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
                    <h4 class="modal-title">Editar datos del Niño/Niña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        <form action="{{ route('actualizar.datos.ocu')}}" id="enviara" method="POST" name="" class="form-control-with-bg">
                            @csrf
							<input type="hidden" name="ide" id="ide" value="">
							<div class="form-group row m-b-15">
								<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Ocupación * :</label>
								<div class="col-md-8 col-sm-8">
									<input class="form-control" type="text" id="fullnam" name="fullnam" pattern="^[A-Za-z]([A-Za-z]|[0-9]|\.| )*[A-Za-z]" placeholder="INGRESE LA OCUPACION" data-parsley-required="true" onkeyup="convertirEnMayusculas(this)" onkeypress="return solo_letras(event)" />
								</div>
							</div>
							<div>
								<p class="mb-2">Estado <span class="text-danger">*</span></p>
								<select id="gene" name="gene" class="default-select2 form-control" data-live-search="true" required>
									
								</select>
							</div>
							<br>
							<div class="text-center">
								<button class="btn btn-primary btn-lg" type="submit">Actualizar Datos</button>
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

	
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
@endsection

@push('scripts')

<script>
    let valor1=0, valor2=0;
    function pendientes(dato){
        let dp = dato;
        if(ped_pendiente.checked) valor1=dp;
        else valor1=0;
        filtrar(valor1, valor2);
    }

    function aprobados(dato){
        let dp = dato;
        if(ped_aprobado.checked) valor2=dp;
        else valor2=0;
        filtrar(valor1, valor2);
    }
</script>

<script>
    function filtrar(dato1, dato2){
        $('#lista'). DataTable().clear().destroy();
        let est_ped1=dato1;
        let est_ped2=dato2;
        $('#lista').DataTable({
            
            "ajax": {
                type:'POST',
                url:'{{ route('ver.lista.ocupaciones.valor') }}',
                data:{ _token: '{{ csrf_token ()}}', est_ped1:est_ped1, est_ped2:est_ped2}
            },
            columns: [
                        {data:'numero'  , name: 'numero'}, 
                        {data: 'descrip' , name: 'descrip'}, 
                        {data: 'estado' , name: 'estado'},
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
        
    }
    
</script>

<script>
	function obtener(dato){
		$.ajax({
			type:'POST',
			url:"{{ route('obtener.ocupacion') }}",
			data:{ _token: '{{ csrf_token ()}}', id:dato},
			success:function(htm){
				$('#ide').val(htm[0]);
				$('#fullnam').val(htm[1]);
				htma = "";
				if(htm[2] == "A"){
					htma += '<option value="A">ACTIVO</option><option value="B">BAJA</option>'
				}
				if(htm[2] == "B"){
					htma += '<option value="B">BAJA</option><option value="A">ACTIVO</option>'
				}
				$('#gene').html(htma);
			}
			
		});
	}
</script>

<script>
    $(document).ready( function () {
        $('#lista').DataTable({
            "ajax": {
                url: "{{route('ver.lista.ocupaciones')}}",
                type: 'GET'
            },
            columns: [
                        {data:'numero'  , name: 'numero'}, 
                        {data: 'descrip' , name: 'descrip'}, 
                        {data: 'estado' , name: 'estado'},
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
                    swal({ icon: "warning", title: "La ocupación ya se encuentra registrado"});
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo actualizar"});
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

@endpush