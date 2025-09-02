<?php

namespace Modules\LetterComponent\Http\Cache;

class FragranceTypeCache
{
    const BASE = 'FRAGRANCE_TYPE';

    const GET = self::BASE . '_GET';

    const GET_EXPIRY = 60 * 30;

    const GET_ALL = self::BASE . '_GET_ALL';

    const GET_ALL_EXPIRY = 60 * 30;
}
