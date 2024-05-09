<?php

namespace App\Enums;

use App\Enums\Traits\HandleOptions;

enum SexEnum: int
{
    use HandleOptions;

    case MALE = 1;
    case FEMALE = 2;

    public function description(): string
    {
        return match ($this) {
            SexEnum::MALE => 'Male',
            SexEnum::FEMALE => 'Female',
        };
    }
}
