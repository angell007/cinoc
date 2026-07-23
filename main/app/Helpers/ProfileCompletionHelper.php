<?php

namespace App\Helpers;

use App\User;

class ProfileCompletionHelper
{
    public const COMPLETION_THRESHOLD = 90;

    public static function assess(User $user): array
    {
        $checks = self::checks($user);
        $filled = count(array_filter($checks, function ($check) {
            return $check['filled'];
        }));
        $total = count($checks);
        $percentage = $total > 0 ? (int) round(($filled / $total) * 100) : 0;
        $missing = [];

        foreach ($checks as $key => $check) {
            if (!$check['filled']) {
                $missing[$key] = $check['label'];
            }
        }

        return [
            'percentage' => $percentage,
            'filled' => $filled,
            'total' => $total,
            'missing' => $missing,
            'is_complete' => $percentage >= self::COMPLETION_THRESHOLD,
            'threshold' => self::COMPLETION_THRESHOLD,
        ];
    }

    public static function canApplyToJobs(User $user): bool
    {
        return self::assess($user)['is_complete'];
    }

    public static function canGenerateCv(User $user): bool
    {
        return self::assess($user)['is_complete'];
    }

    public static function downloadBlockedMessage(User $user): string
    {
        $assessment = self::assess($user);

        return 'Aún no puedes descargar tu hoja de vida en PDF. '
            . 'Completa al menos el ' . $assessment['threshold'] . '% de los campos obligatorios '
            . '(actualmente tienes ' . $assessment['percentage'] . '%). '
            . 'Pendientes: ' . implode(', ', $assessment['missing']) . '.';
    }

    private static function checks(User $user): array
    {
        $summary = trim((string) $user->getProfileSummary('summary'));

        return [
            'first_name' => [
                'label' => 'Nombre',
                'filled' => self::hasText($user->first_name),
            ],
            'first_lastname' => [
                'label' => 'Primer apellido',
                'filled' => self::hasText($user->first_lastname),
            ],
            'national_id_card_number' => [
                'label' => 'Identificación',
                'filled' => self::hasText($user->national_id_card_number),
            ],
            'date_of_birth' => [
                'label' => 'Fecha de nacimiento',
                'filled' => self::hasDate($user->date_of_birth),
            ],
            'nationality_id' => [
                'label' => 'Nacionalidad',
                'filled' => self::hasId($user->nationality_id),
            ],
            'country_id' => [
                'label' => 'País de residencia',
                'filled' => self::hasId($user->country_id),
            ],
            'state_id' => [
                'label' => 'Departamento',
                'filled' => self::hasId($user->state_id),
            ],
            'city_id' => [
                'label' => 'Ciudad',
                'filled' => self::hasId($user->city_id),
            ],
            'phone' => [
                'label' => 'Teléfono',
                'filled' => self::hasText($user->phone),
            ],
            'industry_id' => [
                'label' => 'Industria',
                'filled' => self::hasId($user->industry_id),
            ],
            'functional_area_id' => [
                'label' => 'Área funcional',
                'filled' => self::hasId($user->functional_area_id),
            ],
            'street_address' => [
                'label' => 'Dirección',
                'filled' => self::hasText($user->street_address),
            ],
            'summary' => [
                'label' => 'Resumen del perfil',
                'filled' => $summary !== '',
            ],
            'education' => [
                'label' => 'Educación',
                'filled' => $user->profileEducation()->count() > 0,
            ],
            'experience' => [
                'label' => 'Experiencia laboral',
                'filled' => $user->profileExperience()->count() > 0,
            ],
            'skills' => [
                'label' => 'Habilidades',
                'filled' => $user->profileSkills()->count() > 0,
            ],
            'cv' => [
                'label' => 'Hoja de vida (archivo CV)',
                'filled' => $user->profileCvs()->count() > 0,
            ],
            'image' => [
                'label' => 'Foto de perfil',
                'filled' => self::hasText($user->image),
            ],
        ];
    }

    private static function hasText($value): bool
    {
        return trim((string) $value) !== '';
    }

    private static function hasId($value): bool
    {
        return !empty($value) && (int) $value > 0;
    }

    private static function hasDate($value): bool
    {
        if (empty($value)) {
            return false;
        }

        $date = (string) $value;

        return $date !== '0000-00-00' && $date !== '0000-00-00 00:00:00';
    }
}
