@php $forPdf = false; @endphp
@include('user.partials.cv_data')

<div class="cv-doc">
    <div class="cv-logos">
        <img src="{{ $speLogo }}" alt="Servicio Público de Empleo">
        <img src="{{ $uniocLogo }}" alt="UNIOC Institución Universitaria">
    </div>

    <div class="cv-hero">
        <h1>{{ $cvName }}</h1>
        <p class="cv-role">{{ $cvRole }}</p>
    </div>

    <div class="cv-columns">
        <aside class="cv-left">
            <section class="cv-section">
                <h2 class="cv-section-title">Perfil profesional</h2>
                <p class="cv-text">{{ $cvSummary }}</p>
            </section>

            <section class="cv-section">
                <h2 class="cv-section-title">Fortalezas principales</h2>
                <ul class="cv-list">
                    @forelse($user->profileSkills as $item)
                        <li>{{ $item->getJobSkill('job_skill') }}</li>
                    @empty
                        <li>Sin fortalezas registradas.</li>
                    @endforelse
                </ul>
            </section>

            <section class="cv-section">
                <h2 class="cv-section-title">Información de contacto</h2>
                <div class="cv-contact">
                    @if(!empty($user->phone))
                        <p><span class="label">Fijo:</span> {{ $user->phone }}</p>
                    @endif
                    @if(!empty($user->mobile_num))
                        <p><span class="label">Celular:</span> {{ $user->mobile_num }}</p>
                    @endif
                    <p><span class="label">Email:</span> {{ $user->email }}</p>
                    @if(!empty($user->street_address))
                        <p><span class="label">Dirección:</span> {{ $user->street_address }}</p>
                    @endif
                    @if(!empty($residenceLocation))
                        <p>{{ $residenceLocation }}</p>
                    @endif
                    @if(!empty($birthDate))
                        <p><span class="label">Fecha de nacimiento:</span> {{ $birthDate }}</p>
                    @endif
                    @if(!empty($genderLabel))
                        <p><span class="label">Sexo:</span> {{ $genderLabel }}</p>
                    @endif
                    @if(!empty($bornLocation))
                        <p><span class="label">Lugar de nacimiento:</span> {{ $bornLocation }}</p>
                    @endif
                    @if(!empty($user->expected_salary))
                        <p><span class="label">Aspiración salarial:</span> {{ $user->expected_salary }}@if(!empty($user->salary_currency)) {{ $user->salary_currency }}@endif</p>
                    @endif
                </div>
            </section>

            @if($user->profileLanguages->isNotEmpty())
            <section class="cv-section">
                <h2 class="cv-section-title">Idiomas</h2>
                <ul class="cv-list">
                    @foreach($user->profileLanguages as $item)
                        <li>{{ $item->getLanguage('lang') }} — {{ $item->getLanguageLevel('language_level') }}</li>
                    @endforeach
                </ul>
            </section>
            @endif
        </aside>

        <main class="cv-right">
            <section class="cv-section">
                <h2 class="cv-section-title">Experiencia laboral</h2>
                @forelse($user->profileExperience as $item)
                    <div class="cv-item">
                        <h3 class="cv-item-title">{{ $item->title ?: 'Cargo no registrado' }}</h3>
                        <p class="cv-item-meta">
                            {{ $item->company ?: 'Empresa no registrada' }}
                            |
                            {{ !empty($item->date_start) ? date('d/m/Y', strtotime($item->date_start)) : 'N/D' }}
                            -
                            {{ !empty($item->date_end) ? date('d/m/Y', strtotime($item->date_end)) : 'presente' }}
                        </p>
                        @if(!empty($item->description))
                            <ul class="cv-list">
                                @foreach(preg_split('/\r\n|\r|\n/', trim($item->description)) as $line)
                                    @if(trim($line) !== '')
                                        <li>{{ ltrim($line, "-•* ") }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @empty
                    <p class="cv-text">Sin experiencia laboral registrada.</p>
                @endforelse
            </section>

            <section class="cv-section">
                <h2 class="cv-section-title">Trayectoria académica</h2>
                @forelse($user->profileEducation as $item)
                    @php
                        $statusKey = (string) ($item->education_status ?? '');
                        $statusLabel = $educationStatusLabels[$statusKey] ?? $statusKey;
                    @endphp
                    <div class="cv-item">
                        <h3 class="cv-item-title">{{ $item->institution ?: 'Institución no registrada' }}</h3>
                        <p class="cv-item-meta">{{ $item->degree_title ?: 'Programa no registrado' }}</p>
                        <ul class="cv-list">
                            @if($item->getDegreeLevel('degree_level'))
                                <li>Nivel educativo: {{ $item->getDegreeLevel('degree_level') }}</li>
                            @endif
                            @if(!empty($item->date_completion) && $item->date_completion !== '0000-00-00')
                                <li>Fecha de finalización: {{ date('d/m/Y', strtotime($item->date_completion)) }}</li>
                            @endif
                            @if(!empty($statusLabel))
                                <li>Estado de la formación: {{ $statusLabel }}</li>
                            @endif
                            @if($item->getCountry('country'))
                                <li>País: {{ $item->getCountry('country') }}</li>
                            @endif
                        </ul>
                    </div>
                @empty
                    <p class="cv-text">Sin trayectoria académica registrada.</p>
                @endforelse
            </section>
        </main>
    </div>
</div>
