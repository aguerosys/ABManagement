@extends('layouts.app')

@section('content')

<div class="container">
        <table class="table">
            <thead class="thead-dark table-dark">
                <tr>
                    <th scope="col">Nombre del reporte</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Creación del reporte</th>
                    <th scope="col">
                        <a href="{{ route('product.export')}}">
                            <button type="button" class="btn btn-primary" >
                                    Generar PDF
                            </button>
                        </a>
                        

                    </th>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report )
                <tr >               
                    <td>{{$report->name}}</td>
                    <td class="text-center">{{$report->amount}}</td>
                    <td>{{ $report->created_at->format('d-m-Y H:i:s') }}</td>
                    <td></td>

                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>

@endsection