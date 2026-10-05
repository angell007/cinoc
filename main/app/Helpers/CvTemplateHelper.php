<?php

namespace App\Helpers;

use App\User;
use Carbon\Carbon;

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

        $totalWorkExperienceDays = self::totalWorkExperienceDays($user);

        return [
            'forPdf' => $forPdf,
            'cvName' => $cvName,
            'cvRole' => $cvRole,
            'cvSummary' => $cvSummary,
            'bornLocation' => $bornLocation,
            'residenceLocation' => $residenceLocation,
            'genderLabel' => $genderLabel,
            'birthDate' => $birthDate,
            'totalWorkExperienceDays' => $totalWorkExperienceDays,
            'totalWorkExperienceLabel' => self::formatExperienceMonthsAndDays($totalWorkExperienceDays),
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

    /**
     * Suma los días de todas las experiencias laborales del usuario (cada empleo por separado).
     */
    public static function totalWorkExperienceDays(User $user): int
    {
        $total = 0;

        if (!$user->relationLoaded('profileExperience')) {
            $user->load('profileExperience');
        }

        foreach ($user->profileExperience as $item) {
            if (empty($item->date_start)) {
                continue;
            }

            try {
                $start = Carbon::parse($item->date_start)->startOfDay();
            } catch (\Throwable $e) {
                continue;
            }

            $isCurrent = (int) ($item->is_currently_working ?? 0) === 1;
            if ($isCurrent || empty($item->date_end)) {
                $end = Carbon::today()->startOfDay();
            } else {
                try {
                    $end = Carbon::parse($item->date_end)->startOfDay();
                } catch (\Throwable $e) {
                    continue;
                }
            }

            if ($end->lt($start)) {
                continue;
            }

            $total += $start->diffInDays($end) + 1;
        }

        return $total;
    }

    /**
     * Convierte días totales a meses (30 días) y días restantes, p. ej. 62 → "2 meses y 2 días".
     */
    public static function formatExperienceMonthsAndDays(int $totalDays): string
    {
        if ($totalDays <= 0) {
            return '0 días';
        }

        $months = intdiv($totalDays, 30);
        $days = $totalDays % 30;

        $parts = [];
        if ($months > 0) {
            $parts[] = $months . ' ' . ($months === 1 ? 'mes' : 'meses');
        }
        if ($days > 0) {
            $parts[] = $days . ' ' . ($days === 1 ? 'día' : 'días');
        }

        if ($parts === []) {
            return '0 días';
        }

        return implode(' y ', $parts);
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
