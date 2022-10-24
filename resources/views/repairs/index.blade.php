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
       <!-- Modal create product -->
    <div class="modal fade" id="RepairModal" tabindex="-1" aria-labelledby="RepairModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RepairModalLabel">Agregar una reparacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('repair.store') }}" class="container border p-4 mt-4" method="POST"> 
                        @csrf
                            <div class="mb-3">
                                <label for="inputCode" class="form-label">Codigo</label>
                                <input type="text" class="form-control" aria-describedby="inputCodehelp" name="code">
                                <div id="inputCodehelp" class="form-text">Coloque el codigo</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputDescription" class="form-label">Description</label>
                                <input type="text" class="form-control" aria-describedby="inputNamehelp" name="description">
                                <div id="inputDescriptionhelp" class="form-text">Coloque la descripción</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputDetail" class="form-label">Detalle</label>
                                <input type="text" class="form-control" aria-describedby="inputNamehelp" name="detail">
                                <div id="inputDetailhelp" class="form-text">Coloque el detalle</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputCategory" class="form-label">Categoria</label>
                                <select name="category" id="" class="form-select">
                                    <option value="celular">Celulares</option>
                                    <option value="tablet">Tablets</option>
                                    <option value="lapto">Laptos</option>
                                </select>
                                <div id="inputCategoryHelp" class="form-text">Coloque la categoria</div>
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
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Estado</th>
                    <th scope="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
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
                    <td>{{$repair->detail}}</td>
                    <td>{{ucfirst($repair->category); }}</td>
                    <td>{{$repair->status}}</td>
                    <td class="">
                     

                    <!-- {{route('product.viewAmount', $product)}} -->
                        <a href="" class="button-action">
                            <button class="button-action">
                                <span class="material-icons edit">
                                    edit_note_outlined
                                </span>
                            </button>
                        </a>
                        
                        </button>
                        <!-- {{ route('product.destroy', $product) }} -->
                        <form action="" method="POST">
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
