@extends('layouts.app')

@section('content')
    <form action="{{ route('product.amountUpdate', $product) }}" class="container border p-4 mt-4" method="POST"> 
        @csrf
            <h3 class="modal-title" id="productModalLabel">Modificar la cantidad vendida del producto</h5>
            <hr>
            <h5> <i>Nombre del producto:</i>  {{ $product->name }}</h5>
            <h5> <i>Cantidad en stock:</i>  {{ $product->amount }}  </h5>  
            <hr>
            

            <div class="mb-3">
                <label for="inputTask" class="form-label">Cantidad vendida</label>
                <input type="text" class="form-control" aria-describedby="inputTitlehelp" name="amount">
                <div id="inputTitlehelp" class="form-text">Coloque la cantidad vendida del producto</div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
    </form>
@endsection