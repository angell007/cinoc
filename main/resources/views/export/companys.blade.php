<table>

    <thead>

        <tr>

            <th> # </th>

            <th> Nombre </th>

            <th> email </th>

            <th> Descripción </th>

            <!--<th>  Cantidad de oficinas </th>-->

            <th> Ciudad </th>

            <th> Departamento </th>

            <th> Website </th>

            <th> Número de empleados </th>

            <!--<th>  Fax </th>-->

            <th> Telefono </th>

            <th> Industria </th>

            <th> Activa </th>



        </tr>

    </thead>

    <tbody>

        @foreach ($data as $datum)
            <tr>



                <th> {{ $datum->id }} </th>

                <th> {{ $datum->name }} </th>

                <th> {{ $datum->email }} </th>

                <th> {!! strip_tags("$datum->description") !!} </th>

                <td> {{ isset($datum->city) ? $datum->city->city : '' }} </td>

                <td> {{ isset($datum->state) ? $datum->state->state : '' }} </td>

                <th> {{ $datum->website }} </th>

                <th> {{ $datum->no_of_employees }} </th>

                <th> {{ $datum->phone }} </th>

                <td> {!! isset($datum->industry) ? $datum->industry->industry : '' !!} </td>

                <th> {{ $datum->is_active ? 'Si' : 'No' }} </th>



            </tr>
        @endforeach

    </tbody>

</table>
