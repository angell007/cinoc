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

        $publicRoot = self::publicRoot();
        $speLogoPath = self::resolveAssetPath($publicRoot, [
            'images/cv/spe-header.png',
            'images/cv/spe.png',
            'images/logo_principal_SPE.jpg',
            'images/logo_principal_SPE_.jpg',
        ]) ?: self::resolveAssetPath(base_path(), [
            'storage/app/cv-logos/spe-header.png',
            'storage/app/cv-logos/spe.png',
        ]);
        $uniocLogoPath = self::resolveAssetPath($publicRoot, [
            'images/cv/unioc-header.png',
            'images/cv/unioc.png',
            'images/bannerescuelatecnologicav2.jpg',
            'images/logo.jpeg',
        ]) ?: self::resolveAssetPath(base_path(), [
            'storage/app/cv-logos/unioc-header.png',
            'storage/app/cv-logos/unioc.png',
        ]);

        if ($forPdf) {
            $speLogo = self::imageDataUri($speLogoPath);
            $uniocLogo = self::imageDataUri($uniocLogoPath);
        } else {
            // Preview web: preferir assets públicos; si solo existen en storage, usar data URI.
            $speLogo = self::publicAssetUrl($publicRoot, $speLogoPath)
                ?: self::imageDataUri($speLogoPath)
                ?: asset('images/logo_principal_SPE.jpg');
            $uniocLogo = self::publicAssetUrl($publicRoot, $uniocLogoPath)
                ?: self::imageDataUri($uniocLogoPath)
                ?: asset('images/bannerescuelatecnologicav2.jpg');
        }

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

    public static function publicRoot(): string
    {
        $parent = realpath(base_path('..'));
        if ($parent && is_dir($parent . DIRECTORY_SEPARATOR . 'images')) {
            return $parent;
        }

        return realpath(public_path()) ?: base_path();
    }

    private static function resolveAssetPath(string $root, array $candidates): ?string
    {
        foreach ($candidates as $relative) {
            $path = $root . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relative);
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }

    private static function publicAssetUrl(string $publicRoot, ?string $absolutePath): ?string
    {
        if ($absolutePath === null) {
            return null;
        }

        $normalizedRoot = rtrim(str_replace('\\', '/', $publicRoot), '/');
        $normalizedPath = str_replace('\\', '/', $absolutePath);
        if (strpos($normalizedPath, $normalizedRoot . '/') !== 0) {
            return null;
        }

        $relative = ltrim(substr($normalizedPath, strlen($normalizedRoot)), '/');

        return asset($relative);
    }

    private static function imageDataUri(?string $path): ?string
    {
        if ($path === null || !is_file($path)) {
            return null;
        }

        $mime = function_exists('mime_content_type')
            ? (mime_content_type($path) ?: 'image/png')
            : 'image/png';

        // Los assets del sitio usan extensión .jpg aunque el contenido real sea PNG.
        if (!preg_match('#^image/#', $mime)) {
            $mime = 'image/png';
        }

        return 'data:' . $mime . ';base64,' . base64_encode((string) file_get_contents($path));
    }
}
