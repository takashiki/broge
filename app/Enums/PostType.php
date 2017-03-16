<?php

namespace App\Enums;

final class PostType extends BaseEnum
{
    const DRAFT = 0;
    const ARTICLE = 1;
    const PAGE = 2;

    public static function readables(): array
    {
        return [
            self::DRAFT => __('enums.draft'),
            self::ARTICLE => __('enums.article'),
            self::PAGE => __('enums.page'),
        ];
    }
}
