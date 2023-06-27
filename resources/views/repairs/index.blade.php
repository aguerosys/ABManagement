@extends('layouts.app')
<style>

    .ancho{
        background: none;
        font-size: 25px !important;
    }
    .edit{
        color: #FFC300;
    }
  
    .remove{
        color: #D82148;
    }
    
    .button-action{
        background: none;
        border: none;
        
    }
    a{
        text-decoration: none !important;
    }
</style>
@section('content')
       <!-- Modal create -->
    <div class="modal fade" id="RepairModal" tabindex="-1" aria-labelledby="RepairModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RepairModalLabel">Alta reparacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('repair.store') }}" class="container border p-4 mt-4" method="POST"> 
                        @csrf
                            <div class="mb-3">
                                <label for="inputCode" class="form-label">Codigo</label>
                                <input type="text" class="form-control" aria-describedby="inputCodehelp" name="code" disabled>
                                <div id="inputCodehelp" class="form-text">Coloque el codigo</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputDescription" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" aria-describedby="inputNamehelp" name="description">
                                <div id="inputDescriptionhelp" class="form-text">Coloque la descripción</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputDetail" class="form-label">Detalle</label>
                                <input type="text" class="form-control" aria-describedby="inputNamehelp" name="details">
                                <div id="inputDetailhelp" class="form-text">Coloque el detalle</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputPrice" class="form-label">Precio</label>
                                <input type="text" class="form-control" aria-describedby="inputPricehelp" name="price">
                                <div id="inputPricehelp" class="form-text">Coloque el precio del arreglo</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputCategory" class="form-label">Categoria</label>
                                <select name="category" id="" class="form-select">
                                    <option value="celular">Celulares</option>
                                    <option value="tablet">Tablets</option>
                                    <option value="laptop">Laptos</option>
                                </select>
                                <div id="inputCategoryHelp" class="form-text">Coloque la categoria</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputClient" class="form-label">Cliente</label>
                                <select name="client" id="" class="form-select">
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->lastname . ' ' . $client->firstname }}">{{ $client->firstname . ', ' . $client->lastname }}</option>
                                    @endforeach
                                </select>
                                <div id="inputCategoryHelp" class="form-text">Seleccione el cliente</div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
 

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            
            @foreach($errors->all() as $error)
                - {{$error}} <br>

            @endforeach
        </div>
    @endif

    <div class="container">
        <table class="table">
            <thead class="thead-dark table-dark">
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Precio del arreglo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">Cambiar estado</th>
                    <th scope="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#RepairModal">
                            Crear
                        </button>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($repairs as $repair )
                <tr>                
                    <td>{{$repair->code}}</td>
                    <td>{{$repair->description}}</td>
                    <td>{{$repair->details}}</td>
                    <td>$ {{$repair->price}}</td>
                    <td>{{ucfirst($repair->category); }}</td>
                    <td>{{$repair->status}}</td>
                    <td>{{$repair->client}}</td>
                    <td class="">
                     
                        <a href="" class="button-action">
                            <button class="button-action">
                            <span class="material-symbols-outlined ancho edit">
                                edit_note
                            </span>
                            </button>
                        </a>

                       
                    
                        <form action=" {{route('repair.destroy', $repair) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="button-action" type="submit" onclick="return confirm('¿Desea eliminar?')">
                            <span class="material-symbols-outlined ancho remove">
                                delete
                            </span>
                            </button>
                           
                        </form>
                    </td>
                    <td> 
                        <a href="{{route('repair.doneState', $repair) }}" class="button-action">
                            <button class="button-action">
                                <span class="material-symbols-outlined ancho">
                                    done
                                </span>
                            </button>
                        </a>
                        <a href="{{route('repair.processState', $repair) }}" class="button-action">
                            <button class="button-action">
                                <span class="material-symbols-outlined ancho">
                                    restart_alt
                                </span>
                            </button>
                        </a>
                        
                        <a href="{{route('repair.pendingState', $repair) }}" class="button-action">
                            <button class="button-action">
                                <span class="material-symbols-outlined ancho">
                                    pending
                                </span>
                            </button>
                        </a>
                        
                    </td>
                    <td></td>
                   
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
    
    
@endsection
