<?php

namespace App\Enums\Traits;

use BackedEnum;

/**
 * Trait HandleOptions
 */
trait HandleOptions
{
    /**
     * @param bool $takeDescription
     * @return array
     */
    public static function options(bool $takeDescription = false): array
    {
        $cases = static::cases();
        $data = [];

        if ($takeDescription) {
            foreach ($cases as $case) {
                if ($case instanceof BackedEnum) {
                    $data[] = [
                        'id' => $case->value,
                        'description' => $case->description(),
                    ];
                }
            }

            return $data;
        }

        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'id', 'description')
            : array_column($cases, 'description');
    }

    /**
     * @param int $id
     * @return array
     */
    public static function optionById(int $id): array
    {
        $enum = static::from($id);

        return ['value' => $enum->value, 'description' => $enum->description()];
    }
}
