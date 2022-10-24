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
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Crear producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" class="container border p-4 mt-4" method="POST"> 
                        @csrf
                            <div class="mb-3">
                                <label for="inputCode" class="form-label">Codigo del producto</label>
                                <input type="text" class="form-control" aria-describedby="inputCodehelp" name="code">
                                <div id="inputCodehelp" class="form-text">Coloque el codigo del producto</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputProduct" class="form-label">Producto</label>
                                <input type="text" class="form-control" aria-describedby="inputNamehelp" name="name">
                                <div id="inputNamehelp" class="form-text">Coloque el nombre de su producto</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputCategory" class="form-label">Categoria</label>
                                <select name="category" id="" class="form-select">
                                    <option value="alimentos">Alimentos</option>
                                    <option value="lacteos">Lacteos</option>
                                    <option value="cigarillos">Cigarrillos</option>
                                    <option value="otros"> Otros</option>
                                </select>
                                <div id="inputCategoryHelp" class="form-text">Coloque la cantidad</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputAmount" class="form-label">Cantidad</label>
                                <input type="text" class="form-control" aria-describedby="inputAmounthelp" name="amount">
                                <div id="inputAmounthelp" class="form-text">Coloque la cantidad</div>
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
                    <th scope="col">Producto</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Accion</th>
                    <th scope="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                            Crear
                        </button>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product )
                <tr>                
                    <td>{{$product->code}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{ucfirst($product->category); }}</td>
                    <td>{{$product->amount}}</td>
                    <td class="">
                     

                        
                        <a href="{{route('product.viewAmount', $product)}}" class="button-action">
                            <button class="button-action">
                                <span class="material-icons edit">
                                    edit_note_outlined
                                </span>
                            </button>
                        </a>
                        
                        </button>
                        <form action="{{ route('product.destroy', $product) }}" method="POST">
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
