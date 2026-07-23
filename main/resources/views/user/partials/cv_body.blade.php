<div class="wrapper" style="margin-top:50px">
    <div class="sidebar-wrapper">
        <div class="profile-container">
            @if(!empty($cvImageSource))
            <img class="profile" style="border-radius: 100%" width="150" src="{{ $cvImageSource }}" alt="{{ $user->getName() }}" />
            @endif
            <h1 class="name">{{ $user->getName() }}</h1>
            <h3 class="tagline">{{ $user->getFunctionalArea('functional_area') }}</h3>
        </div>

        <div class="">
            <ul class="list-unstyled contact-list">
                <li>Email: {{ $user->email }}</li>
                <li>Documento: {{ $user->national_id_card_number }}</li>
                <li>Contacto: {{ $user->mobile_num }}</li>
                @if(!empty($user->street_address))
                <li>Dirección: {{ $user->street_address }}</li>
                @endif
            </ul>
        </div>
    </div>

    <div class="main-wrapper">
        <section class="section summary-section" style="margin-top:70px">
            <h2 class="section-title">Acerca de mí</h2>
            <div class="summary">
                <p>{{ $user->getProfileSummary('summary') ?: 'Sin información registrada.' }}</p>
            </div>
        </section>

        <div class="page_break"></div>

        <section class="section experiences-section" style="margin-top:70px;">
            <h2 class="section-title">Educación</h2>
            @forelse($user->profileEducation as $item)
            <div class="item">
                <div class="meta">
                    <div class="upper-row">
                        <h3 class="job-title">Título: {{ $item->degree_title }}</h3>
                        <div class="time">Finalización: {{ $item->date_completion }}</div>
                    </div>
                    <div>Institución: {{ $item->institution }}</div>
                </div>
            </div>
            @empty
            <p>Sin registros de educación.</p>
            @endforelse
        </section>

        <section class="section experiences-section">
            <h2 class="section-title">Experiencia</h2>
            @forelse($user->profileExperience as $item)
            <div class="item">
                <div class="meta">
                    <div class="upper-row">
                        <h3 class="job-title">Cargo: {{ $item->title }}</h3>
                        <div class="time">
                            {{ date('d-m-Y', strtotime($item->date_start)) }} -
                            {{ date('d-m-Y', strtotime($item->date_end)) }}
                        </div>
                    </div>
                    <div>Compañía: {{ $item->company }}</div>
                </div>
                <p>Funciones: {{ $item->description }}</p>
            </div>
            @empty
            <p>Sin registros de experiencia.</p>
            @endforelse
        </section>

        <section class="section projects-section">
            <h2 class="section-title">Habilidades</h2>
            <ul>
                @forelse($user->profileSkills as $item)
                <li>{{ $item->getJobSkill('job_skill') }}</li>
                @empty
                <li>Sin habilidades registradas.</li>
                @endforelse
            </ul>
        </section>

        <section class="section projects-section">
            <h2 class="section-title">Idiomas</h2>
            <ul>
                @forelse($user->profileLanguages as $item)
                <li>
                    Idioma: {{ $item->getLanguage('lang') }} -
                    Nivel: {{ $item->getLanguageLevel('language_level') }}
                </li>
                @empty
                <li>Sin idiomas registrados.</li>
                @endforelse
            </ul>
        </section>
    </div>
</div>
