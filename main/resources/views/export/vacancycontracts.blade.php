<table>
    <thead>
    <tr>
        <th>Empresa</th>
        <th>Vacante</th>
        <th>Candidato</th>
        <th>Email de candidato</th>
        <th>Rol</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vacancys as $user)
    
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->title }}</td>
            <td>{{ $user->estudent }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->rol }}</td>
        </tr>
    @endforeach
    </tbody>
</table>