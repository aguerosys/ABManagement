@extends('layouts.app')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100&display=swap');
   
    *{
        font-family: 'Roboto Mono', monospace;
       
   }
    .pointer{
        cursor: pointer;
        text-decoration: none;
        color: black;
        font-size: 16;

    }
    .pointer:hover{
        color: black;
    }
    .card-title{
        font-size: 25px;
        text-align: center;
        font-weight: bold;
        border-left: 0.8px solid #ccc;

    }
    .img-main{
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 25%;
        height: 60%;
        transform: scale(1);
        transition: .3s ease-in-out;
        
    }
  
    .img-main:hover{
        transform: scale(0.9);
    }
    .title-main{
        font-weight: bold;
    }
</style>
@section('content')
   <h1 class="text-center mb-4 title-main"> {{ strtoupper(__('¡Bienvenido al sistema!'))}} </h1>
   <div class="container-fluid">
       <div class="card-group">
            <a href="{{ route('product.index') }}" class="card pointer ">
                <div class="transform">
                    <img class="img-main " src="img/stock.png" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Productos</h4>
                        <p class="card-text">Aquí podrás gestionar tus productos, agregar stock, descontar stock, entre otras funcionalidades.</p>
                    
                    </div>
                </div>
            </a>
            <a href="{{ route('reports.index') }}" class="card pointer ">
                <div class="transform">
                    <img class="img-main " src="img/reports.png" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Reportes</h4>
                        <p class="card-text">Aquí podrás gestionar tus reportes, verás detallado por fecha cada descuento o aumento de stock de tu negocio.</p>
                    
                    </div>
                </div>
            </a>       
        </div>

        <div class="card-group">
        <a href="{{ route('product.index') }}" class="card pointer ">
                <div class="transform">
                    <img class="img-main " src="img/clientes.png" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Clientes</h4>
                        <p class="card-text">Aquí podrás gestionar tus clientes, dar de alta, dar de baja, modificar datos y demas.</p>
                    
                    </div>
                </div>
            </a>

            <a href="{{ route('repair.index') }}" class="card pointer ">
                <div class="transform">
                    <img class="img-main " src="img/repair.png" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">Reparaciones</h4>
                        <p class="card-text">Aquí podrás gestionar los equipos que se encuentren en reparacion, podrás gestionar su estado y sus observaciones.</p>
                    
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection 