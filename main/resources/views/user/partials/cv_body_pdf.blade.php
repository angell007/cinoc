@php $forPdf = true; @endphp
@include('user.partials.cv_data')

<style>
    body { margin: 0; padding: 0; }
</style>

<table width="100%" cellpadding="0" cellspacing="0" style="font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #5a6570; border-collapse: collapse;">
    <tr>
        <td style="background:#f2f4f7; padding:12px 18px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="50%" align="left">
                        @if(file_exists($speLogoPath))
                            <img src="{{ $speLogo }}" height="46" alt="SPE">
                        @else
                            <span style="color:#0b3a6e; font-weight:bold;">Servicio Público de Empleo</span>
                        @endif
                    </td>
                    <td width="50%" align="right">
                        @if(file_exists($uniocLogoPath))
                            <img src="{{ $uniocLogo }}" height="46" alt="UNIOC">
                        @else
                            <span style="color:#0b3a6e; font-weight:bold;">UNIOC</span>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="background:#0b3a6e; color:#ffffff; text-align:center; padding:20px 12px;">
            <div style="font-size:24px; font-weight:bold; letter-spacing:3px; text-transform:uppercase; color:#ffffff;">{{ $cvName }}</div>
            <div style="font-size:12px; letter-spacing:3px; text-transform:uppercase; margin-top:8px; color:#ffffff;">{{ $cvRole }}</div>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #5a6570; border-collapse: collapse;">
    <tr>
        <td width="34%" valign="top" style="padding:18px 14px; border-right:1px solid #edf0f4;">
            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Perfil profesional</div>
            <div style="border-top:1px solid #2f6ea8; margin-bottom:10px;"></div>
            <p style="margin:0 0 16px; text-align:justify; line-height:1.45;">{{ $cvSummary }}</p>

            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Fortalezas principales</div>
            <div style="border-top:1px solid #2f6ea8; margin-bottom:10px;"></div>
            @forelse($user->profileSkills as $item)
                <div style="margin:0 0 6px;">- {{ $item->getJobSkill('job_skill') }}</div>
            @empty
                <div style="margin:0 0 16px;">- Sin fortalezas registradas.</div>
            @endforelse

            <div style="height:10px;"></div>
            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Información de contacto</div>
            <div style="border-top:1px solid #2f6ea8; margin-bottom:10px;"></div>
            @if(!empty($user->phone))
                <div style="margin:0 0 6px;"><strong>Fijo:</strong> {{ $user->phone }}</div>
            @endif
            @if(!empty($user->mobile_num))
                <div style="margin:0 0 6px;"><strong>Celular:</strong> {{ $user->mobile_num }}</div>
            @endif
            <div style="margin:0 0 6px;"><strong>Email:</strong> {{ $user->email }}</div>
            @if(!empty($user->street_address))
                <div style="margin:0 0 6px;"><strong>Dirección:</strong> {{ $user->street_address }}</div>
            @endif
            @if(!empty($residenceLocation))
                <div style="margin:0 0 6px;">{{ $residenceLocation }}</div>
            @endif
            @if(!empty($birthDate))
                <div style="margin:0 0 6px;"><strong>Fecha de nacimiento:</strong> {{ $birthDate }}</div>
            @endif
            @if(!empty($genderLabel))
                <div style="margin:0 0 6px;"><strong>Sexo:</strong> {{ $genderLabel }}</div>
            @endif
            @if(!empty($bornLocation))
                <div style="margin:0 0 6px;"><strong>Lugar de nacimiento:</strong> {{ $bornLocation }}</div>
            @endif
            @if(!empty($user->expected_salary))
                <div style="margin:0 0 6px;"><strong>Aspiración salarial:</strong> {{ $user->expected_salary }}@if(!empty($user->salary_currency)) {{ $user->salary_currency }}@endif</div>
            @endif

            @if($user->profileLanguages->isNotEmpty())
                <div style="height:12px;"></div>
                <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Idiomas</div>
                <div style="border-top:1px solid #2f6ea8; margin-bottom:10px;"></div>
                @foreach($user->profileLanguages as $item)
                    <div style="margin:0 0 6px;">- {{ $item->getLanguage('lang') }} — {{ $item->getLanguageLevel('language_level') }}</div>
                @endforeach
            @endif
        </td>

        <td width="66%" valign="top" style="padding:18px 20px;">
            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Experiencia laboral</div>
            <div style="border-top:2px solid #2f6ea8; margin-bottom:12px;"></div>

            @forelse($user->profileExperience as $item)
                <div style="margin:0 0 14px;">
                    <div style="color:#2f6ea8; font-size:13px; font-weight:bold;">{{ $item->title ?: 'Cargo no registrado' }}</div>
                    <div style="color:#7a8692; font-style:italic; margin:2px 0 6px;">
                        {{ $item->company ?: 'Empresa no registrada' }}
                        |
                        {{ !empty($item->date_start) ? date('d/m/Y', strtotime($item->date_start)) : 'N/D' }}
                        -
                        {{ !empty($item->date_end) ? date('d/m/Y', strtotime($item->date_end)) : 'presente' }}
                    </div>
                    @if(!empty($item->description))
                        @foreach(preg_split('/\r\n|\r|\n/', trim($item->description)) as $line)
                            @if(trim($line) !== '')
                                <div style="margin:0 0 4px;">- {{ ltrim($line, "-•* ") }}</div>
                            @endif
                        @endforeach
                    @endif
                </div>
            @empty
                <div style="margin:0 0 16px;">Sin experiencia laboral registrada.</div>
            @endforelse

            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin:8px 0 4px;">Trayectoria académica</div>
            <div style="border-top:2px solid #2f6ea8; margin-bottom:12px;"></div>

            @forelse($user->profileEducation as $item)
                @php
                    $statusKey = (string) ($item->education_status ?? '');
                    $statusLabel = $educationStatusLabels[$statusKey] ?? $statusKey;
                @endphp
                <div style="margin:0 0 14px;">
                    <div style="color:#2f6ea8; font-size:13px; font-weight:bold;">{{ $item->institution ?: 'Institución no registrada' }}</div>
                    <div style="color:#7a8692; font-style:italic; margin:2px 0 6px;">{{ $item->degree_title ?: 'Programa no registrado' }}</div>
                    @if($item->getDegreeLevel('degree_level'))
                        <div style="margin:0 0 4px;">- Nivel educativo: {{ $item->getDegreeLevel('degree_level') }}</div>
                    @endif
                    @if(!empty($item->date_completion) && $item->date_completion !== '0000-00-00')
                        <div style="margin:0 0 4px;">- Fecha de finalización: {{ date('d/m/Y', strtotime($item->date_completion)) }}</div>
                    @endif
                    @if(!empty($statusLabel))
                        <div style="margin:0 0 4px;">- Estado de la formación: {{ $statusLabel }}</div>
                    @endif
                    @if($item->getCountry('country'))
                        <div style="margin:0 0 4px;">- País: {{ $item->getCountry('country') }}</div>
                    @endif
                </div>
            @empty
                <div>Sin trayectoria académica registrada.</div>
            @endforelse
        </td>
    </tr>
</table>
