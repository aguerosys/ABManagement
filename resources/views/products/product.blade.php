@extends('layouts.app')

@section('content')

    
<form action="{{ route('product.store') }}" class="container border p-4 mt-4" method="POST"> 
    @csrf
        <div class="mb-3">
            <label for="inputTask" class="form-label">Codigo del producto</label>
            <input type="text" class="form-control" aria-describedby="inputTitlehelp" name="code">
            <div id="inputTitlehelp" class="form-text">Coloque el codigo del producto</div>
        </div>
        <div class="mb-3">
            <label for="inputTask" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" aria-describedby="inputTitlehelp" name="name">
            <div id="inputTitlehelp" class="form-text">Coloque el nombre del producto</div>
        </div>

        <div class="mb-3">
            <label for="inputTask" class="form-label">Cantidad</label>
            <input type="text" class="form-control" aria-describedby="inputTitlehelp" name="amount">
            <div id="inputTitlehelp" class="form-text">Coloque la cantidad del producto</div>
        </div>
        
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
</form>

@endsection