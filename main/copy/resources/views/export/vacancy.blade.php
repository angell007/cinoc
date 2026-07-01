<table>

    <thead>

        <tr>
            <th>Empresa</th>

            <th>Vacante</th>

            <th>Descripcion</th>

            <th>Candidato</th>

            <th>Identificacion</th>

            <th>Programa</th>

            <th>Email de candidato</th>

            <th>Contacto</th>

            <th>Rol</th>

            <th> Sexo
            </th>
            <th> Grupo poblacional
            </th>

        </tr>

    </thead>

    <tbody>

        @foreach ($vacancys as $user)
            <tr>

                <td>{{ $user->company->name ?? $user->company }}</td>

                <td>{{ $user->title }}</td>

                <td>{{ strip_tags(html_entity_decode($user->description)) }}</td>

                <td>{{ $user->candidato }}</td>

                <td>{{ $user->identificacion }}</td>

                <td>{{ $user->programa }}</td>

                <td>{{ $user->email }}</td>

                <td>{{ strip_tags(html_entity_decode($user->mobile_num)) }}</td>

                <td>{{ $user->rol }}</td>

                <td> {{ $user->gender }} </td>

                <td> {{ $user->marital_status }}  </td>

            </tr>
        @endforeach

    </tbody>

</table>
