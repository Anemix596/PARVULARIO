@extends('layouts.default')

@section('title', 'Registro de Bajas')

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
	<h1 class="page-header">Registro de Bajas</h1>
	
	<div class="col-xl-12">

		<div class="panel panel-info">
			
			<div class="panel-heading">
				<h4 class="panel-title">LISTA DE INSCRIPCIONES DADAS DE BAJA</h4>
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
								<th class="text-nowrap" data-orderable="false"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ACCIONES &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
							</tr>
						</thead>
						<tbody>
	
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
		
	</div>
	
@endsection

@push('scripts')

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
	function eliminar(e){
		$.ajax({
			type:'POST',
			url:"{{ route('obtener.inscripcion') }}",
			data:{ _token: '{{ csrf_token ()}}', id:e},
			success:function(htm){
				$('#pid').val(htm[13]);
				$('#pest').html(htm[0]);
				if(htm[4] == "M"){
					$('#pturno').html('MAÑANA');
				}
				if(htm[4] == "T"){
					$('#pturno').html('TARDE');
				}
				$('#pnivel').html(htm[3]);
				$('#pperiodo').html(htm[5]);
				$('#pfechai').html(htm[7]);
				$('#pfechaf').html(htm[8]);
				
			}
			
		});
	}
</script>

<script>
	var $select =$("#periodo2a").change(function(){
		var e = $(this).val();
		$('#periodo2a').val(e);
		desbloquear2($('#periodo2a').val());
	});

	function desbloquear2(e){
		if(e != ''){
			const f = e, fe=f.split("/");
			let dias = new Date(fe[1], fe[0], 0).getDate();
			let fecha = "01-"+(parseInt(fe[0])<10?"0"+fe[0]:fe[0])+"-"+fe[1];
			let fecha2 = dias+"-"+(parseInt(fe[0])<10?"0"+fe[0]:fe[0])+"-"+fe[1];
			
			$("#datepicker-disabled-past3").datepicker();
			$('#datepicker-disabled-past3').datepicker('setStartDate', fecha);
			$('#datepicker-disabled-past3').datepicker('setEndDate', fecha2);
			$("#fechai2a").prop('disabled', false);
		}
		else{
			$("#datepicker-disabled-past3").datepicker("disabled");	
			$("#fechai2a").prop('disabled', true);
			
		}
	}

	function fecha_ultima(e){
		$.ajax({
			type:'POST',
			url:"{{ route('obtener.fecha.ultima') }}",
			data:{ _token: '{{ csrf_token ()}}', id:e},
			success:function(htm){
				if(htm != '')
					$('#fechai2a').val(htm);
				desbloquear($('#fechai2a').val());
				calcular_precio();
			}
			
		});
	}
</script>

<script>
	function desbloquear(e){
		if(e != ''){
			let fecha = $("#fechai2a").val();
			$("#datepicker-disabled-past4").datepicker();
			$('#datepicker-disabled-past4').datepicker('setStartDate', fecha);
			$("#fechaf2a").prop('disabled', false);
			$("#precio2a").prop('disabled', false);
			calcular_precio();
		}
		else{
			$("#datepicker-disabled-past4").datepicker("disabled");	
			$("#fechaf2a").prop('disabled', true);
			$("#precio2a").prop('disabled', true);
			
		}
	}

	var $select =$("#nivel2a").change(function(){
		var e = $(this).val();
		$('#niv').val(e);
	});

	function calcular_precio(){
		let fi = $('#fechai2a').val();
		let ff = $('#fechaf2a').val();
		let n = $('#niv').val();
		
		if(fi != '' && ff != '' && n != ''){
			$.ajax({
				type:'POST',
				url:"{{ route('calcular.precio') }}",
				data:{ _token: '{{ csrf_token ()}}', fi: fi, ff:ff, id:n},
				success:function(html){
					$('#precio2a').val(html);
				}
				
			});
		}
	}

	function calcular_precio3(){
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

	function listar_nivel(){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.nivel') }}',
			success:function(html){
				$('#nivel2a').html(html);
			}
			
		});
	}

	function listar_periodo(){
		$.ajax({
			type:'GET',
			url:'{{ route('listar.periodo') }}',
			success:function(html){
				$('#periodo2a').html(html);
			}
			
		});
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
				else if(html == 3){
                    swal({ icon: "warning", title: "El periodo se está llevando actualmente"});
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
				else if(html == 3){
                    swal({ icon: "warning", title: "El periodo se está llevando actualmente"});
                }
                else{
                    swal({ icon: "error", title: "Error, no se pudo registrar"});
                }
                
            }
        });
    });

	$(document).on("submit" ,"#eliminar", function(e){
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
					$('#modal-alert').modal('hide');
					$('#lista').DataTable().ajax.reload();
                    swal({ icon: "success", title: "Se ha dado de baja"});
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
		listar_nivel()
		listar_periodo()
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
				fecha_ultima(htm[13]);
				$('#nivel2a').val(htm[3]);
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
                url: "{{route('ver.lista.inscripcion4')}}",
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
				{ targets: 7, visible: false},
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
</script>

<script>
	function calcular(e){
		if(e != '' && $('#fechai2a').val() !=''){
			let fecha = $('#fechai2a').val();
			$.ajax({
				type:'POST',
				url:"{{ route('calcular.fecha') }}",
				data:{ _token: '{{ csrf_token ()}}', f:fecha, d:e},
				success:function(html){
					$('#fechaf2a').val(html);
					calcular_precio();
				}
				
			});
		}
		else{
			if(e != '') calcular(e);
			else{
				$('#fechaf2a').val('');
				$('#precio2a').val('');
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
				$('#datepicker-disabled-past3').datepicker('setStartDate', html[0]);
				$('#datepicker-disabled-past4').datepicker('setStartDate', html[1]);
			}
			
		});
	}

	function iniciar_fecha2(){
		$.ajax({
			type:'GET',
			url:'{{ route('recuperar.fecha') }}',
			success:function(html){
				$('#datepicker-disabled-past').datepicker('setStartDate', html[0]);
				$('#datepicker-disabled-past2').datepicker('setStartDate', html[1]);
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