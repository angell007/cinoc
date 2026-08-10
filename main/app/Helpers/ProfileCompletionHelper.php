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
        return [
            'date_of_birth' => [
                'label' => 'Fecha de nacimiento',
                'filled' => self::hasDate($user->date_of_birth),
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
        ];
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
