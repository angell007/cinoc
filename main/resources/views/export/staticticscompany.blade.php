<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($companys as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ($user->is_active) ? 'Activa' : 'Inactiva'  }}</td>
        </tr>
    @endforeach
    </tbody>
</table>