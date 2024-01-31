@switch($valor)
    
    @case(1) 
        <div class="form-inline">
            <abbr title="Ver Datos">
                <button onclick="obtener('{{$id}}')" class="btn btn-info" data-toggle="modal" data-target="#modal-without-animation">
                    <i class="far fa-eye"></i>
                </button>&nbsp;
            </abbr>
        </div>
        @break
    @case(2) 
        <div class="form-inline">
            <abbr title="Ver Datos">
                <button onclick="obtener('{{$id}}')" class="btn btn-info" data-toggle="modal" data-target="#modal-dialog">
                    <i class="far fa-eye"></i>
                </button>&nbsp;
            </abbr>
        </div>
    @break

    @case(3) 
        <div class="form-inline">
            <abbr title="Ver Datos">
                <button onclick="obtener('{{$id}}')" class="btn btn-info" data-toggle="modal" data-target="#modal-dialog">
                    <i class="far fa-eye"></i>
                </button>&nbsp;
            </abbr>
        </div>
    @break

    @case(4) 
        <div class="form-inline">
            <abbr title="Ver Datos">
                <button onclick="editar('{{$id}}')" class="btn btn-info" data-toggle="modal" data-target="#modal-dialog">
                    <i class="far fa-eye"></i>
                </button>&nbsp;
            </abbr>

            <abbr title="Ver Recibo">
                <button onclick="recibo('{{$id}}')" class="btn btn-pink">
                    <i class="fas fa-file-alt"></i>
                </button>&nbsp;
            </abbr>
        </div>
    @break

    @case(5) 
        <div class="form-inline">
            @if ($estado == 0)
            <abbr title="Registrar Devolución">
                <button onclick="registrar('{{$id}}')" class="btn btn-info" data-toggle="modal" data-target="#modal-dialog4">
                    <i class="far fa-eye"></i>
                </button>&nbsp;
            </abbr>
            @endif
            @if ($estado == 1)
            <abbr title="Editar Devolución">
                <button onclick="editar('{{$id}}')" class="btn btn-info" data-toggle="modal" data-target="#modal-dialog">
                    <i class="far fa-eye"></i>
                </button>&nbsp;
            </abbr>
            @endif
        </div>
    @break

    @case(6) 
        <div class="form-inline">
            <abbr title="Registrar Cobro">
                <button onclick="registrar('{{$id}}')" class="btn btn-info" data-toggle="modal" data-target="#modal-dialog4">
                    <i class="far fa-eye"></i>
                </button>&nbsp;
            </abbr>

            @if ($estado == "VIGENTE")
                <abbr title="Editar Cobro">
                    <button onclick="editar('{{$id}}')" class="btn btn-success" data-toggle="modal" data-target="#modal-dialog">
                        <i class="far fa-edit"></i>
                    </button>&nbsp;
                </abbr>
            @endif
            
            @if ($estado == "VENCIDO")
                <abbr title="Dar de Baja">
                    <button onclick="eliminar('{{$id}}')" class="btn btn-danger" data-toggle="modal" data-target="#modal-alert">
                        <i class="fas fa-trash"></i>
                    </button>&nbsp;
                </abbr>
            @endif

            <abbr title="Ver Recibo">
                <button onclick="recibo('{{$id}}')" class="btn btn-pink">
                    <i class="fas fa-file-alt"></i>
                </button>&nbsp;
            </abbr>
        </div>
    @break

    @case(7) 
        
    @break
        
    @default
        
@endswitch
