<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h1 class="text-center p-3">CRUD Producto</h1>

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
                <h1 class="modal-title fs-5">Registro del Producto</h1>
               
            </div>
            <div class="modal-body">
                <form action="{{route('crud.create')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Codigo del Producto</label>
                        <input type="text" id="exampleInputEmail1" name="txtcodigo">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Nombre del Producto</label>
                        <input type="text" id="exampleInputEmail1" name="txtnombre">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Precio del Producto</label>
                        <input type="text" id="exampleInputEmail1" name="txtprecio">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Cantidad del Producto</label>
                        <input type="text" id="exampleInputEmail1" name="txtcantidad">
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
         <!-- Botón de añadir Producto -->
        <button class="btn-success" onclick="document.getElementById('modalRegistrar').style.display='block'"> Añadir Producto</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Código (ID)</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $item)
                    <tr>
                        <th scope="row">{{ $item->id_producto }}</th>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->precio }}</td>
                        <td><b>$</b>{{ $item->cantidad }}</td>
                        <td><button><a onclick="document.getElementById('modalEditar{{$item->id_producto}}').style.display='block'">editar</a></button>
                            </button><a href="{{route("crud.delete", $item->id_producto )}}" onclick="return res()">borrar</a></button>
                        </td>
                        
                        <!-- Modal de modificacion de datos -->
                        <div class="modal" id="modalEditar{{$item->id_producto}}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Modificar datos del Producto</h1>
                                    
                                </div>
                                <div class="modal-body">
                                    <form action="{{route("crud.update")}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Codigo del Producto</label>
                                            <input type="text" id="exampleInputEmail1" name="txtcodigo" value="{{$item->id_producto}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Nombre del Producto</label>
                                            <input type="text" id="exampleInputEmail1" name="txtnombre" value="{{$item->nombre}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Precio del Producto</label>
                                            <input type="text" id="exampleInputEmail1" name="txtprecio" value = "{{$item->precio}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Cantidad del Producto</label>
                                            <input type="text" id="exampleInputEmail1" name="txtcantidad" value="{{$item->cantidad}}">
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" onclick="document.getElementById('modalEditar{{$item->id_producto}}').style.display='none'">Cerrar</button>
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
        <a style="border-color: red; color: red;" href="{{ route('crudEncargado.index') }}">CRUD encargado</a>
    </div>

</body>

</html>
