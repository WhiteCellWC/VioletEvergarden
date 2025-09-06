<?php

namespace App\Enums;

use App\Constant\Constant;

enum OrderType: string
{
    case ASC = Constant::ascending;

    case DESC = Constant::descending;
}
