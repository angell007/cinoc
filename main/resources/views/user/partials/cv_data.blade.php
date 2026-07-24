@php
    $cvName = mb_strtoupper($user->getName() ?: 'CANDIDATO', 'UTF-8');
    $cvRole = mb_strtoupper(trim((string) ($user->rol ?: $user->getFunctionalArea('functional_area') ?: 'Candidato')), 'UTF-8');
    $cvSummary = $user->getProfileSummary('summary') ?: 'Sin perfil profesional registrado.';

    $bornCountryModel = $user->countryborn()->lang()->first() ?: $user->countryborn()->first();
    $bornStateModel = $user->stateborn()->lang()->first() ?: $user->stateborn()->first();
    $bornCityModel = $user->cityborn()->lang()->first() ?: $user->cityborn()->first();
    $bornLocation = trim(implode(', ', array_filter([
        $bornCityModel->city ?? null,
        $bornStateModel->state ?? null,
        $bornCountryModel->country ?? null,
    ])));

    $residenceLocation = $user->getLocation();
    $genderLabel = $user->getGender('gender');
    $birthDate = !empty($user->date_of_birth) && $user->date_of_birth !== '0000-00-00'
        ? date('d/m/Y', strtotime($user->date_of_birth))
        : null;

    $educationStatusLabels = [
        'en_curso' => 'En curso',
        'incompleto' => 'Incompleto',
        'graduado' => 'Graduado',
    ];

    $speLogoPath = public_path('images/logo_principal_SPE.jpg');
    $uniocLogoPath = public_path('images/bannerescuelatecnologicav2.jpg');
    if (!file_exists($uniocLogoPath)) {
        $uniocLogoPath = public_path('images/logo.jpeg');
    }

    $speLogo = !empty($forPdf) && file_exists($speLogoPath) ? $speLogoPath : asset('images/logo_principal_SPE.jpg');
    $uniocLogo = !empty($forPdf) && file_exists($uniocLogoPath) ? $uniocLogoPath : asset(file_exists(public_path('images/bannerescuelatecnologicav2.jpg')) ? 'images/bannerescuelatecnologicav2.jpg' : 'images/logo.jpeg');
@endphp
