<?php

namespace App\Enums;

enum PriorityStatus: string
{
    case Low = 'low';
    case Normal = 'normal';
    case High = 'high';
}