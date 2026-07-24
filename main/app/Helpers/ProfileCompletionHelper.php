<?php

namespace App\Helpers;

use App\ProfileEducation;
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
        $education = self::educationReference($user);

        return [
            'date_of_birth' => [
                'label' => 'Fecha de nacimiento',
                'filled' => self::hasDate($user->date_of_birth),
            ],
            'borncountry_id' => [
                'label' => 'País de nacimiento',
                'filled' => self::hasId($user->borncountry_id),
            ],
            'bornstate_id' => [
                'label' => 'Departamento de nacimiento',
                'filled' => self::hasId($user->bornstate_id),
            ],
            'borncity_id' => [
                'label' => 'Municipio de nacimiento',
                'filled' => self::hasId($user->borncity_id),
            ],
            'gender_id' => [
                'label' => 'Sexo',
                'filled' => self::hasId($user->gender_id),
            ],
            'country_id' => [
                'label' => 'País de residencia',
                'filled' => self::hasId($user->country_id),
            ],
            'state_id' => [
                'label' => 'Departamento de residencia',
                'filled' => self::hasId($user->state_id),
            ],
            'city_id' => [
                'label' => 'Municipio de residencia',
                'filled' => self::hasId($user->city_id),
            ],
            'education_degree_title' => [
                'label' => 'Educación: título de la formación académica',
                'filled' => $education !== null && self::hasText($education->degree_title),
            ],
            'education_degree_level' => [
                'label' => 'Educación: nivel educativo',
                'filled' => $education !== null && self::hasId($education->degree_level_id),
            ],
            'education_date_completion' => [
                'label' => 'Educación: fecha de finalización',
                'filled' => $education !== null && self::hasDate($education->date_completion),
            ],
            'education_status' => [
                'label' => 'Educación: estado de la formación',
                'filled' => $education !== null && self::hasText($education->education_status),
            ],
            'education_country' => [
                'label' => 'Educación: país',
                'filled' => $education !== null && self::hasId($education->country_id),
            ],
            'expected_salary' => [
                'label' => 'Aspiración salarial',
                'filled' => self::hasText($user->expected_salary),
            ],
        ];
    }

    /**
     * Usa el registro de educación más completo; si hay empate, el más reciente.
     */
    private static function educationReference(User $user): ?ProfileEducation
    {
        $educations = $user->relationLoaded('profileEducation')
            ? $user->profileEducation
            : $user->profileEducation()->get();

        if ($educations->isEmpty()) {
            return null;
        }

        return $educations->sortByDesc(function ($education) {
            $score = 0;
            $score += self::hasText($education->degree_title) ? 1 : 0;
            $score += self::hasId($education->degree_level_id) ? 1 : 0;
            $score += self::hasDate($education->date_completion) ? 1 : 0;
            $score += self::hasText($education->education_status) ? 1 : 0;
            $score += self::hasId($education->country_id) ? 1 : 0;

            return ($score * 100000) + (int) $education->id;
        })->first();
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
