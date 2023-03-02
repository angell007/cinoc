<table>
    <thead>
        <tr>
            <th> #
            </th>
            <th> Primer Nombre
            </th>
            <th> Segundo nombre </th>
            <th> Apellidos
            </th>
            <th> Email
            </th>
            <th> Identificación
            </th>
            <th> Ciudad
            </th>
            <th> Departamento
            </th>
            <th> Teléfono </th>
            <th> Rol
            </th>
            <th> Área funcional
            </th>
            <th> Habilidad
            </th>
            <th> Industria
            </th>
            <th> Nivel de estudio </th>
            <th> Activo
            </th>
            <th> Fecha de registro
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $datum)
            <tr>
                <td> {{ $datum->id }}
                </td>
                <td> {{ $datum->first_name }}
                </td>
                <td> {{ $datum->middle_name }}
                </td>
                <td> {{ $datum->first_lastname . ' ' . $datum->second_lastname }} </td>
                <td> {{ $datum->email }}
                </td>
                <td> {{ $datum->national_id_card_number }}
                </td>
                <td> {{ $datum->city }}
                </td>
                <td> {{ $datum->state }}
                </td>
                <td> {!! strval(intval($datum->phone)) !!}
                </td>
                <td> {{ $datum->rol }}
                </td>
                <td> {{ $datum->functional_area }}
                </td>

                <?php $porciones = explode('--', $datum->skill); ?> @if (count($porciones) > 0)
                    <td>
                        <ul>
                            @foreach ($porciones as $p)
                                <li> {{ $p }} </li>
                            @endforeach
                        </ul>
                    </td>
                @else
                    <td></td>
                @endif

                <td> {{ $datum->getIndustry('industry') }}
                </td>
                <td> {{ $datum->career_level }}
                </td>
                <td> {{ $datum->is_active ? 'Si' : 'No' }}
                </td>
                <td> {{ $datum->created_at }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
