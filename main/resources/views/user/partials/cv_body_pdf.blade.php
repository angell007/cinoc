@php extract(\App\Helpers\CvTemplateHelper::data($user, true)); @endphp

{{-- Encabezado: logos completos + franja azul (formato guía) --}}
<table width="100%" cellpadding="0" cellspacing="0" style="font-family: DejaVu Sans, Arial, sans-serif; border-collapse: collapse; table-layout: fixed;">
    <tr>
        <td style="background:#ffffff; padding:8px 18px 12px;">
            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                <tr>
                    <td width="45%" align="left" valign="middle" style="height:78px;">
                        @if(!empty($speLogo))
                            <img src="{{ $speLogo }}" width="90" height="65" alt="SPE" style="width:90px; height:65px;">
                        @else
                            <span style="color:#6b1f2a; font-weight:bold; font-size:11px;">Servicio Público de Empleo</span>
                        @endif
                    </td>
                    <td width="55%" align="right" valign="middle" style="height:78px;">
                        @if(!empty($uniocLogo))
                            <img src="{{ $uniocLogo }}" width="170" height="48" alt="UNIOC" style="width:170px; height:48px; margin-left:auto;">
                        @else
                            <div style="text-align:right;">
                                <span style="color:#0b3a6e; font-weight:bold; font-size:18px;">UNIOC</span><br>
                                <span style="color:#0b3a6e; font-size:9px;">Institución Universitaria</span>
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="background:#0b3a6e; text-align:center; padding:26px 20px 24px;">
            <div style="font-size:28px; font-weight:bold; letter-spacing:2px; text-transform:uppercase; color:#ffffff; line-height:1.15;">{{ $cvName }}</div>
            <div style="font-size:12px; font-weight:normal; letter-spacing:4px; text-transform:uppercase; margin-top:10px; color:#ffffff;">{{ $cvRole }}</div>
        </td>
    </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #5a6570; border-collapse: collapse;">
    <tr>
        <td width="34%" valign="top" style="padding:22px 16px 28px 20px; border-right:1px solid #edf0f4;">
            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Perfil profesional</div>
            <div style="border-top:1px solid #2f6ea8; margin-bottom:10px;"></div>
            <p style="margin:0 0 18px; text-align:justify; line-height:1.5;">{{ $cvSummary }}</p>

            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Fortalezas principales</div>
            <div style="border-top:1px solid #2f6ea8; margin-bottom:10px;"></div>
            @forelse($user->profileSkills as $item)
                <div style="margin:0 0 6px;">- {{ $item->getJobSkill('job_skill') ?: 'Habilidad registrada' }}</div>
            @empty
                <div style="margin:0 0 16px;">- Sin fortalezas registradas.</div>
            @endforelse

            <div style="height:12px;"></div>
            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Información de contacto</div>
            <div style="border-top:1px solid #2f6ea8; margin-bottom:10px;"></div>
            @if(!empty($user->phone))
                <div style="margin:0 0 7px;"><strong>Fijo:</strong> {{ $user->phone }}</div>
            @endif
            @if(!empty($user->mobile_num))
                <div style="margin:0 0 7px;"><strong>Celular:</strong> {{ $user->mobile_num }}</div>
            @endif
            <div style="margin:0 0 7px;"><strong>Email:</strong> {{ $user->email }}</div>
            @if(!empty($user->street_address))
                <div style="margin:0 0 7px;"><strong>Dirección:</strong> {{ $user->street_address }}</div>
            @endif
            @if(!empty($residenceLocation))
                <div style="margin:0 0 7px;">{{ $residenceLocation }}</div>
            @endif
            @if(!empty($birthDate))
                <div style="margin:0 0 7px;"><strong>Fecha de nacimiento:</strong> {{ $birthDate }}</div>
            @endif
            @if(!empty($genderLabel))
                <div style="margin:0 0 7px;"><strong>Sexo:</strong> {{ $genderLabel }}</div>
            @endif
            @if(!empty($bornLocation))
                <div style="margin:0 0 7px;"><strong>Lugar de nacimiento:</strong> {{ $bornLocation }}</div>
            @endif
            @if(!empty($user->expected_salary))
                <div style="margin:0 0 7px;"><strong>Aspiración salarial:</strong> {{ $user->expected_salary }}@if(!empty($user->salary_currency)) {{ $user->salary_currency }}@endif</div>
            @endif

            @if(isset($user->profileLanguages) && $user->profileLanguages->count() > 0)
                <div style="height:14px;"></div>
                <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Idiomas</div>
                <div style="border-top:1px solid #2f6ea8; margin-bottom:10px;"></div>
                @foreach($user->profileLanguages as $item)
                    <div style="margin:0 0 6px;">- {{ $item->getLanguage('lang') ?: 'Idioma' }} — {{ $item->getLanguageLevel('language_level') ?: 'Nivel no registrado' }}</div>
                @endforeach
            @endif
        </td>

        <td width="66%" valign="top" style="padding:22px 24px 28px 22px;">
            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Experiencia laboral</div>
            <div style="border-top:2px solid #2f6ea8; margin-bottom:12px;"></div>

            @forelse($user->profileExperience as $item)
                <div style="margin:0 0 16px;">
                    <div style="color:#2f6ea8; font-size:13px; font-weight:bold;">{{ $item->title ?: 'Cargo no registrado' }}</div>
                    <div style="color:#7a8692; font-style:italic; margin:3px 0 7px;">
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
                <div style="margin:0 0 18px;">Sin experiencia laboral registrada.</div>
            @endforelse

            <div style="color:#0b3a6e; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin:6px 0 4px;">Trayectoria académica</div>
            <div style="border-top:2px solid #2f6ea8; margin-bottom:12px;"></div>

            @forelse($user->profileEducation as $item)
                @php
                    $statusKey = (string) ($item->education_status ?? '');
                    $statusLabel = $educationStatusLabels[$statusKey] ?? $statusKey;
                    try { $degreeLevelLabel = $item->getDegreeLevel('degree_level'); } catch (\Throwable $e) { $degreeLevelLabel = null; }
                    try { $educationCountry = $item->getCountry('country'); } catch (\Throwable $e) { $educationCountry = null; }
                @endphp
                <div style="margin:0 0 16px;">
                    <div style="color:#2f6ea8; font-size:13px; font-weight:bold;">{{ $item->institution ?: 'Institución no registrada' }}</div>
                    <div style="color:#7a8692; font-style:italic; margin:3px 0 7px;">{{ $item->degree_title ?: 'Programa no registrado' }}</div>
                    @if($degreeLevelLabel)
                        <div style="margin:0 0 4px;">- Nivel educativo: {{ $degreeLevelLabel }}</div>
                    @endif
                    @if(!empty($item->date_completion) && $item->date_completion !== '0000-00-00')
                        <div style="margin:0 0 4px;">- Fecha de finalización: {{ date('d/m/Y', strtotime($item->date_completion)) }}</div>
                    @endif
                    @if(!empty($statusLabel))
                        <div style="margin:0 0 4px;">- Estado de la formación: {{ $statusLabel }}</div>
                    @endif
                    @if($educationCountry)
                        <div style="margin:0 0 4px;">- País: {{ $educationCountry }}</div>
                    @endif
                </div>
            @empty
                <div>Sin trayectoria académica registrada.</div>
            @endforelse
        </td>
    </tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
    <tr>
        <td style="background:#f5a623; height:18px; line-height:18px; font-size:1px;">&nbsp;</td>
    </tr>
</table>
