<table>
    <thead>
        <tr>
             <td> Código del prestador </td>
             <td> Código de la vacante</td>
             <td> Título de la vacante </td>
             <td> Descripción de la vacante </td>
             <td> Tiempo de experiencia relacionado </td>
             <td> Nivel de estudio requerido </td>
             <td> Profesión </td>
             <td> Salario</td>
             <td> Cantidad de vancantes </td>
             <td> Cargo </td>
             <td> Código tipo de documento del empleador </td>
             <td> Número de identificación del empleador </td>
             <td> Razón social </td>
             <td> Solicitud de excepción de publicación por parte del empleador </td>
             <td> Fecha  de publicación  </td>
             <td> Fecha  de vencimiento </td>
             <td> Código de municipio </td>
             <td> Sector económico </td>
             <td> Tipo de Contrato </td>
             <td> Teletrabajo </td>
             <td> Discapacidad </td>
             <td> URL al detalle de la vacante  </td>
           
        </tr>
    </thead>
    <tbody>
        @foreach($data as $datum)
        <tr>
            
    <td> {{ $datum->company_id }}</td>
    <td> {{ $datum->id}}</td>
    <td> {{ $datum->title }}</td>
    <td style="word-wrap: break-word;
    word-break: break-all;
    white-space: normal;"> {!! $datum->description !!}</td>
    <td> {{ $datum->job_experience }}</td>
    <td> {{ $datum->functional_area }}</td>
    <td> {{ $datum->degree_level }}</td>
    <td> {{ $datum->salary_currency }}</td>
    <td> {{ $datum->num_of_positions }}</td>
    <td> {{ $datum->position }}</td>
    <td> {{ $datum->tipo_identificacion }}</td>
    <td> {{ $datum->identificacion }}</td>
    <td> {{ $datum->name }}</td>
    <td> {{ ($datum->show_info) ? 'S' : 'N' }}</td>
    <td> {{ $datum->created_at }}</td>
    <td> {{ $datum->expiry_date }}</td>
    <td> {{ $datum->city_id }}</td>
    <td> {{ $datum->industry }}</td>
    <td> {{ $datum->job_type }}</td>
    <td> {{ ($datum->is_freelance) ? '1' : '0' }}</td>
    <td> 0 </td>
    <td> https://bolsaempleo.iescinoc.edu.co/job/{{  $datum->slug }}</td>
    
    <!--<td> {{ $datum->salary_from }}</td>-->
    <!--<td> {{ $datum->salary_to }}</td>-->
    <!--<td> {{ $datum->num_of_positions }}</td>-->
    <!--<td> {{ $datum->expiry_date }}</td>-->
    <!--<td> {{ ($datum->is_active) ? 'Si' : 'No' }}</td>-->
   
           
        </tr>
        @endforeach
    </tbody>
</table>