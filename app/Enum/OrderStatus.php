<?php

namespace App\Enum;

enum OrderStatus: string
{
    case Error = "Ошибка";
    case Waiting = "В ожидании";
    case Success = "Завершено";
}
