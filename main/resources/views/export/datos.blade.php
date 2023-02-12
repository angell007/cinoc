<table>
    <thead>
        <tr>
            <th colspan="2">
                <h4>Datos del sistema</h4>
            </th>
        </tr>
        <tr>
            <th colspan="2">Fecha: {{date('d-m-Y')}}</th>
        </tr>
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>

            <th>Dato</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>


        <tr>
            <td> Empresas registradas mes actual</td>
            <td>{{ $company_registered }}</td>
        </tr>
        
        @foreach($results as $index => $result)
        <tr>
            <td> {{$index}} </td>
            <td>{{ count($result) }}</td>
        </tr>
        @endforeach

        
    </tbody>
</table>