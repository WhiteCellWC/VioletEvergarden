<?php

namespace App\Enums;

use App\Constant\Constant;

enum FlagType: string
{
    case SUCCESS = Constant::success;

    case ERROR = Constant::error;

    case WARNING = Constant::warning;
}
