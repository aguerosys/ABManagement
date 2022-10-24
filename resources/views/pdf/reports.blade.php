

<div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre del reporte</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Cantidad agregada</th>
                    <th scope="col">Cantidad descontada</th>
                    <th scope="col">Creación del reporte</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report )
                <tr >               
                    <td>{{$report->name}}</td>
                    <td class="text-center">{{$report->amount}}</td>
                    <td class="text-center">{{$report->amountAdd}}</td>
                    <td class="text-center">{{$report->amountSold}}</td>
                    <td>{{ $report->created_at->format('d-m-Y H:i:s') }}</td>

                </tr>
                @endforeach   
            </tbody>
        </table>
    </div>
