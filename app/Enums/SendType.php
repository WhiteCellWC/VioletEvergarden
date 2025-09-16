<?php

namespace App\Enums;

use App\Constant\Constant;

enum SendType: string
{
    case PHYSICAL = Constant::physical;

    case DIGITAL = Constant::digital;
}
