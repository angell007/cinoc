<?php

namespace App\Helpers;

use App\User;

class CvTemplateHelper
{
    public static function data(User $user, bool $forPdf = false): array
    {
        $cvName = mb_strtoupper((string) ($user->getName() ?: 'CANDIDATO'), 'UTF-8');

        $roleSource = $user->rol;
        if ($roleSource === null || $roleSource === '') {
            $roleSource = $user->getFunctionalArea('functional_area');
        }
        if (!is_scalar($roleSource) || $roleSource === null || $roleSource === '') {
            $roleSource = 'Candidato';
        }
        $cvRole = mb_strtoupper(trim((string) $roleSource), 'UTF-8');

        try {
            $cvSummary = $user->getProfileSummary('summary') ?: 'Sin perfil profesional registrado.';
        } catch (\Throwable $e) {
            $cvSummary = 'Sin perfil profesional registrado.';
        }

        $bornCountryModel = null;
        $bornStateModel = null;
        $bornCityModel = null;

        try {
            if (!empty($user->borncountry_id)) {
                $bornCountryModel = $user->countryborn()->lang()->first() ?: $user->countryborn()->first();
            }
            if (!empty($user->bornstate_id)) {
                $bornStateModel = $user->stateborn()->lang()->first() ?: $user->stateborn()->first();
            }
            if (!empty($user->borncity_id)) {
                $bornCityModel = $user->cityborn()->lang()->first() ?: $user->cityborn()->first();
            }
        } catch (\Throwable $e) {
            // Si falla la relación de nacimiento, la HV sigue renderizando.
        }

        $bornLocation = trim(implode(', ', array_filter([
            $bornCityModel ? $bornCityModel->city : null,
            $bornStateModel ? $bornStateModel->state : null,
            $bornCountryModel ? $bornCountryModel->country : null,
        ])));

        try {
            $residenceLocation = $user->getLocation();
        } catch (\Throwable $e) {
            $residenceLocation = '';
        }

        try {
            $genderLabel = $user->getGender('gender');
        } catch (\Throwable $e) {
            $genderLabel = null;
        }

        $birthDate = null;
        if (!empty($user->date_of_birth) && (string) $user->date_of_birth !== '0000-00-00') {
            $birthDate = date('d/m/Y', strtotime($user->date_of_birth));
        }

        $speLogoPath = public_path('images/logo_principal_SPE.jpg');
        $uniocLogoPath = public_path('images/bannerescuelatecnologicav2.jpg');
        if (!file_exists($uniocLogoPath)) {
            $uniocLogoPath = public_path('images/logo.jpeg');
        }

        $speLogo = $forPdf && file_exists($speLogoPath)
            ? $speLogoPath
            : asset('images/logo_principal_SPE.jpg');

        $uniocLogo = $forPdf && file_exists($uniocLogoPath)
            ? $uniocLogoPath
            : asset(file_exists(public_path('images/bannerescuelatecnologicav2.jpg'))
                ? 'images/bannerescuelatecnologicav2.jpg'
                : 'images/logo.jpeg');

        return [
            'forPdf' => $forPdf,
            'cvName' => $cvName,
            'cvRole' => $cvRole,
            'cvSummary' => $cvSummary,
            'bornLocation' => $bornLocation,
            'residenceLocation' => $residenceLocation,
            'genderLabel' => $genderLabel,
            'birthDate' => $birthDate,
            'educationStatusLabels' => [
                'en_curso' => 'En curso',
                'incompleto' => 'Incompleto',
                'graduado' => 'Graduado',
            ],
            'speLogoPath' => $speLogoPath,
            'uniocLogoPath' => $uniocLogoPath,
            'speLogo' => $speLogo,
            'uniocLogo' => $uniocLogo,
        ];
    }
}
