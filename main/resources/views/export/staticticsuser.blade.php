<table>

    <thead>

    <tr>

        <th>Nombre</th>

        <th>Documento</th>

        <th>Email</th>

        <th>Contacto</th>

        <th>rol</th>

    </tr>

    </thead>

    <tbody>

    @foreach($users as $user)

        <tr>

            <td>{{ $user->name }}</td>

            <td>{{ $user->national_id_card_number }}</td>

            <td>{{ $user->email }}</td>

            <td>{{ $user->functional_area }}</td>

            <td>{{ $user->mobile_num }}</td>

            <td>{{ $user->rol }}</td>

        </tr>

    @endforeach

    </tbody>

</table>