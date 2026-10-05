<?php

namespace App\Helpers;

class UserLaborProfileOptions
{
    public static function jobSituations(): array
    {
        $options = [
            '' => 'Seleccione situación laboral',
            'Empleado (Trabajador dependiente)' => 'Empleado (Trabajador dependiente)',
            'Desempleado (En búsqueda activa de empleo)' => 'Desempleado (En búsqueda activa de empleo)',
            'Autónomo (Independiente / Freelance)' => 'Autónomo (Independiente / Freelance)',
            'Estudiante' => 'Estudiante',
            'Jubilado / Pensionado' => 'Jubilado / Pensionado',
        ];

        return $options + self::legacyJobSituations();
    }

    /** Valores históricos del formulario; se mantienen para perfiles ya guardados. */
    public static function legacyJobSituations(): array
    {
        return [
            'Empleado' => 'Empleado (registro anterior)',
            'Desempleado' => 'Desempleado (registro anterior)',
            'Jubilado' => 'Jubilado (registro anterior)',
            'Otro' => 'Otro (registro anterior)',
            'Primer empleo' => 'Primer empleo (registro anterior)',
            'Independiente' => 'Independiente (registro anterior)',
            'Cesante por emergencia sanitaria' => 'Cesante por emergencia sanitaria (registro anterior)',
        ];
    }

    public static function workModalities(): array
    {
        return [
            '' => 'Seleccione modalidad de trabajo',
            'Presencial' => 'Presencial',
            'Remoto (Teletrabajo)' => 'Remoto (Teletrabajo)',
            'Híbrido' => 'Híbrido',
        ];
    }

    public static function workScheduleTypes(): array
    {
        return [
            '' => 'Seleccione tipo de jornada',
            'Jornada completa (Tiempo completo)' => 'Jornada completa (Tiempo completo)',
            'Media jornada (Tiempo parcial)' => 'Media jornada (Tiempo parcial)',
            'Por proyectos / Freelance' => 'Por proyectos / Freelance',
            'Prácticas / Pasantía' => 'Prácticas / Pasantía',
            'Turnos rotativos' => 'Turnos rotativos',
        ];
    }
}
