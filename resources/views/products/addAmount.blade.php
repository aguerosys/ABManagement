@extends('layouts.app')

@section('content')

    <form action="{{ route('product.update', $product) }}" class="container border p-4 mt-4" method="POST"> 
            @csrf
                <h3 class="modal-title" id="productModalLabel">Modificar datos generales del producto</h5>
                <hr>

                <div class="mb-3">
                    <label for="inputCode" class="form-label">Codigo del producto</label>
                    <input type="text" class="form-control" aria-describedby="inputTitlehelp" name="code" value="{{ $product->code }}">
                    <div id="inputTitlehelp" class="form-text">Coloque el nuevo codigo del producto</div>
                </div>
                <div class="mb-3">
                    <label for="inputName" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" aria-describedby="inputTitlehelp" name="name" value="{{ $product->name }}">
                    <div id="inputTitlehelp" class="form-text">Coloque el nuevo nombre del producto</div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" onclick="return confirm('¿Desea guardar?')">Guardar</button>
                </div>
    </form>

    <form action="{{ route('product.addAmount', $product) }}" class="container border p-4 mt-4" method="POST"> 
        @csrf
            <h3 class="modal-title" id="productModalLabel">Agregar stock al producto</h5>
            <hr>
            <h5> <i>Nombre del producto:</i>  {{ $product->name }}</h5>
            <h5> <i>Cantidad en stock:</i>  {{ $product->amount }}  </h5>  
            <hr>
            

            <div class="mb-3">
                <label for="inputTask" class="form-label">Cantidad a agregar</label>
                <input type="text" class="form-control" aria-describedby="inputTitlehelp" name="amount">
                <div id="inputTitlehelp" class="form-text">Coloque la cantidad que desea agregar</div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" onclick="return confirm('¿Desea Guardar?')">Guardar</button>
            </div>
    </form>

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
                <button type="submit" class="btn btn-success" onclick="return confirm('¿Desea guardar?')">Guardar</button>
            </div>
    </form>
@endsection