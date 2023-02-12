<table>
    <thead>
    <tr>
        
       
        <th>Empresa</th>
        <th>Vacante</th>
        <th>Candidato</th>
        <th>Email de candidato</th>
        <th>Contacto</th>
        <th>Rol</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vacancys as $user)
        <tr>
            <td>{{ $user->company }}</td>
            <td>{{ $user->title }}</td>
            <td>{{ $user->candidato }}</td>
            <td>{{ $user->email }}</td>
            <td>{!! $user->mobile_num !!}</td>
            <td>{{ $user->rol }}</td>
        </tr>
    @endforeach
    </tbody>
</table>