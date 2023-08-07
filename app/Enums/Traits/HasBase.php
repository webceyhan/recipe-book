<?php 

namespace App\Enums\Traits;

trait HasBase {
    public static function keys(): array
    {
        return array_column(static::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }
}