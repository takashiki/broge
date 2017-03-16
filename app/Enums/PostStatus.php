<?php

namespace App\Enums;

final class PostStatus extends BaseEnum
{
    const DRAFT = 0;
    const NORMAL = 1;

    public static function readables(): array
    {
        return [
            self::DRAFT => __('enums.draft'),
            self::NORMAL => __('enums.normal'),
        ];
    }
}
