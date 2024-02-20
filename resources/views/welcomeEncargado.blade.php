<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h1 class="text-center p-3">CRUD Encargado</h1>

    @if (session("correcto"))
        <div class="alert-success">{{session("correcto")}}</div>
    @endif
    @if (session("incorrecto"))
        <div class="alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
        var res=function(){
            var not=confirm("¿Estas seguro de eliminar?");
            return not;
        }
    </script>

    <!-- Modal de registro de datos -->
    <div class="modal" id="modalRegistrar">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Registro del Encargado</h1>
               
            </div>
            <div class="modal-body">
                <form action="{{route('crud.createEncargado')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Codigo del Encargado</label>
                        <input type="text" id="exampleInputEmail1" name="txtcodigo">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Nombre del Encargado</label>
                        <input type="text" id="exampleInputEmail1" name="txtnombre">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Area del Encargado</label>
                        <input type="text" id="exampleInputEmail1" name="txtarea">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Sueldo del Encargado</label>
                        <input type="text" id="exampleInputEmail1" name="txtsueldo">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" onclick="document.getElementById('modalRegistrar').style.display='none'">Cerrar</button>
                        <button type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="p-5 table-responsive">
         <!-- Botón de añadir Encargado -->
        <button class="btn-success" onclick="document.getElementById('modalRegistrar').style.display='block'"> Añadir Encargado</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código (ID)</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Area</th>
                    <th scope="col">Sueldo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                    <tr>
                        <th scope="row">{{ $item->id_usuario }}</th>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->area }}</td>
                        <td><b>$</b>{{ $item->sueldo }}</td>
                        <td><button><a onclick="document.getElementById('modalEditar{{$item->id_usuario}}').style.display='block'">editar</a></button>
                            </button><a href="{{route("crud.deleteEncargado", $item->id_usuario )}}" onclick="return res()">borrar</a></button>
                        </td>
                        
                        <!-- Modal de modificacion de datos -->
                        <div class="modal" id="modalEditar{{$item->id_usuario}}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Modificar datos del Encargado</h1>
                                    
                                </div>
                                <div class="modal-body">
                                    <form action="{{route("crud.updateEncargado")}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Codigo del Encargado</label>
                                            <input type="text" id="exampleInputEmail1" name="txtcodigo" value="{{$item->id_usuario}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Nombre del Encargado</label>
                                            <input type="text" id="exampleInputEmail1" name="txtnombre" value="{{$item->nombre}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Area del Encargado</label>
                                            <input type="text" id="exampleInputEmail1" name="txtarea" value = "{{$item->area}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Sueldo del Encargado</label>
                                            <input type="text" id="exampleInputEmail1" name="txtsueldo" value="{{$item->sueldo}}">
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" onclick="document.getElementById('modalEditar{{$item->id_usuario}}').style.display='none'">Cerrar</button>
                                            <button type="submit">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>  

                     </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="text-align: center;">
        <a style="border-color: red; color: red;" href="{{ route('crud.index') }}">CRUD productos</a>
    </div>

</body>

</html>
