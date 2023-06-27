@extends('layouts.app')
<style>

    .material-icons{

        background: none;
        font-size: 30px !important;
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
</style>
@section('content')
       <!-- Modal create -->
    <div class="modal fade" id="ClientModal" tabindex="-1" aria-labelledby="RepairModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RepairModalLabel">Alta cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('client.store') }}" class="container border p-4 mt-4" method="POST"> 
                        @csrf
                            <div class="mb-3">
                                <label for="inputCode" class="form-label">Nombre</label>
                                <input type="text" class="form-control" aria-describedby="inputCodehelp" name="firstname">
                                <div id="inputCodehelp" class="form-text">Coloque el nombre del cliente</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputDescription" class="form-label">Apellido</label>
                                <input type="text" class="form-control" aria-describedby="inputNamehelp" name="lastname">
                                <div id="inputDescriptionhelp" class="form-text">Coloque el apellido del cliente</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputDetail" class="form-label">Email</label>
                                <input type="text" class="form-control" aria-describedby="inputNamehelp" name="email">
                                <div id="inputDetailhelp" class="form-text">Coloque el email del cliente</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputPrice" class="form-label">Telefono</label>
                                <input type="text" class="form-control" aria-describedby="inputPricehelp" name="phone">
                                <div id="inputPricehelp" class="form-text">Coloque el telefono del cliente</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputPrice" class="form-label">Direccion</label>
                                <input type="text" class="form-control" aria-describedby="inputPricehelp" name="address">
                                <div id="inputPricehelp" class="form-text">Coloque la direccion del cliente</div>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ClientModal">
                            Crear
                        </button>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client )
                <tr>                
                    <td>{{$client->firstname}}</td>
                    <td>{{$client->lastname}}</td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->phone}}</td>
                    <td>{{ucfirst($client->address); }}</td>
                    <td class="">
                     

                    
                        <a href="" class="button-action">
                            <button class="button-action">
                                <span class="material-icons edit">
                                    edit_note_outlined
                                </span>
                            </button>
                        </a>
                        
                        </button>
                        <form action=" {{route('client.destroy', $client) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="button-action" type="submit" onclick="return confirm('¿Desea eliminar?')">
                                <span class="material-icons remove">
                                    delete_outlined
                                </span>
                            </button>
                           
                        </form>
                    </td>
                    <td>
                        
                    </td>
                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
    
    
@endsection
