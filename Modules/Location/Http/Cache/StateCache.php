<?php

namespace Modules\Location\Http\Cache;

class StateCache
{
    const BASE = 'STATE';

    const GET = self::BASE . '_GET';

    const GET_EXPIRY = 60 * 30;

    const GET_ALL = self::BASE . '_GET_ALL';

    const GET_ALL_EXPIRY = 60 * 30;
}
