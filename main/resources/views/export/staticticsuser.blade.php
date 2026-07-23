<html>

<head>
    <title>Reporte de Asesorías de CV</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <table>

        <thead>

            <tr>

                <th>Nombre</th>

                <th>Documento</th>

                <th>Email</th>

                <th>Programa academico</th>

                <th>Contacto</th>

                <th>rol</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->national_id_card_number }}</td>

                    <td>{{ $user->email }}</td>

                    <td>{{ $user->functional_area }}</td>

                    <td>{{ $user->mobile_num }}</td>

                    <td>{{ $user->rol }}</td>

                    <td>{{ $user->created_at }}</td>

                </tr>
            @endforeach

        </tbody>

    </table>
</body>

</html>
